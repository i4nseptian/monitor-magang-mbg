<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentationResource\Pages;
use App\Models\Documentation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentationResource extends Resource
{
    protected static ?string $model = Documentation::class;

    protected static ?string $navigationIcon = 'heroicon-o-camera';

    protected static ?string $navigationLabel = 'Dokumentasi & Galeri';

    protected static ?string $modelLabel = 'Dokumentasi';

    protected static ?string $pluralModelLabel = 'Dokumentasi Magang';

    protected static ?string $navigationGroup = 'Kegiatan Magang';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dokumentasi')
                    ->description('Lengkapi detail dokumentasi kegiatan magang')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Nama Mahasiswa')
                            ->relationship('user', 'name', fn (Builder $query) => $query->mahasiswa())
                            ->required()
                            ->searchable()
                            ->preload()
                            ->default(fn () => Auth::user()->isMahasiswa() ? Auth::id() : null)
                            ->disabled(fn () => Auth::user()->isMahasiswa())
                            ->dehydrated()
                            ->columnSpan(2),

                        Forms\Components\TextInput::make('judul')
                            ->label('Judul Dokumentasi')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Rapat Koordinasi dengan Diskominfo')
                            ->columnSpan(2),

                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Tanggal Dokumentasi')
                            ->default(now())
                            ->required()
                            ->displayFormat('d M Y'),

                        Forms\Components\Textarea::make('keterangan')
                            ->label('Keterangan / Deskripsi')
                            ->rows(3)
                            ->placeholder('Keterangan foto atau detail kegiatan...')
                            ->columnSpan(2),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Unggah Foto')
                    ->description('Format: JPG, PNG, WEBP. Maksimal 20MB per file.')
                    ->icon('heroicon-o-cloud-arrow-up')
                    ->schema([
                        Forms\Components\FileUpload::make('photos')
                            ->label('')
                            ->multiple()
                            ->image()
                            ->directory('documentations')
                            ->maxSize(20480)
                            ->rules(['mimetypes:image/jpeg,image/png,image/webp'])
                            ->imageResizeMode('contain')
                            ->imageResizeTargetWidth(1920)
                            ->imageResizeTargetHeight(1080)
                            ->panelLayout('grid')
                            ->reorderable()
                            ->appendFiles()
                            ->openable()
                            ->downloadable()
                            ->previewable(true)
                            ->loadingIndicatorPosition('left')
                            ->panelAspectRatio('4:3')
                            ->removeUploadedFileButtonPosition('right')
                            ->uploadButtonPosition('center')
                            ->uploadProgressIndicatorPosition('center')
                            ->helperText('Klik atau seret foto ke sini. Bisa upload beberapa foto sekaligus.')
                            ->required(),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Mahasiswa')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color('primary')
                    ->visible(fn () => !Auth::user()->isMahasiswa()),

                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul Dokumentasi')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(40),

                Tables\Columns\ImageColumn::make('photos.photo_path')
                    ->label('Foto')
                    ->stacked()
                    ->circular()
                    ->limit(3)
                    ->height(50)
                    ->width(50),

                Tables\Columns\TextColumn::make('photos_count')
                    ->label('Jumlah')
                    ->counts('photos')
                    ->badge()
                    ->color('warning')
                    ->icon('heroicon-o-photo'),

                Tables\Columns\TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Diunggah')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('tanggal', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Mahasiswa')
                    ->relationship('user', 'name', fn (Builder $query) => $query->mahasiswa())
                    ->visible(fn () => !Auth::user()->isMahasiswa())
                    ->searchable()
                    ->preload(),

                Tables\Filters\Filter::make('tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal_dari')->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('tanggal_hingga')->label('Hingga Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['tanggal_dari'], fn (Builder $query, $date) => $query->whereDate('tanggal', '>=', $date))
                            ->when($data['tanggal_hingga'], fn (Builder $query, $date) => $query->whereDate('tanggal', '<=', $date));
                    })
                    ->columns(2)
                    ->columnSpan(2),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label('Lihat Detail'),
                    Tables\Actions\EditAction::make()
                        ->label('Edit'),
                    Tables\Actions\Action::make('download')
                        ->label('Unduh Foto')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->url(fn ($record) => $record->photos->first() ? Storage::url($record->photos->first()->photo_path) : null)
                        ->openUrlInNewTab()
                        ->visible(fn ($record) => $record->photos->isNotEmpty()),
                    Tables\Actions\DeleteAction::make()
                        ->label('Hapus'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        // Eager load relations to prevent N+1 queries
        $query = parent::getEloquentQuery()->with(['user', 'photos']);
        if (Auth::user()->isMahasiswa()) {
            $query->where('user_id', Auth::id());
        }
        return $query;
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocumentations::route('/'),
            'create' => Pages\CreateDocumentation::route('/create'),
            'edit' => Pages\EditDocumentation::route('/{record}/edit'),
            'view' => Pages\ViewDocumentation::route('/{record}'),
        ];
    }
}
