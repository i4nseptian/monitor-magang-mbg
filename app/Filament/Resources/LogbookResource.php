<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LogbookResource\Pages;
use App\Models\Logbook;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class LogbookResource extends Resource
{
    protected static ?string $model = Logbook::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'Logbook Harian';

    protected static ?string $modelLabel = 'Logbook';

    protected static ?string $pluralModelLabel = 'Logbook Harian';

    protected static ?string $navigationGroup = 'Kegiatan Magang';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return (string) Logbook::where('status', 'Menunggu Review')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kegiatan')
                    ->description('Lengkapi detail kegiatan magang harian')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Nama Mahasiswa')
                            ->relationship('user', 'name', fn (Builder $query) => $query->role('mahasiswa'))
                            ->required()
                            ->searchable()
                            ->preload()
                            ->default(fn () => Auth::user()->isMahasiswa() ? Auth::id() : null)
                            ->disabled(fn () => Auth::user()->isMahasiswa())
                            ->dehydrated(),

                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Tanggal Kegiatan')
                            ->default(now())
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (callable $set, $state) {
                                if ($state) {
                                    $set('hari_ke', Logbook::calculateHariKe(new \DateTime($state)));
                                }
                            }),

                        Forms\Components\TextInput::make('hari_ke')
                            ->label('Hari Ke-')
                            ->numeric()
                            ->required()
                            ->default(fn () => Logbook::calculateHariKe(new \DateTime())),

                        Forms\Components\Select::make('kategori_kegiatan')
                            ->label('Kategori Kegiatan')
                            ->options(array_combine(Logbook::KATEGORI, Logbook::KATEGORI))
                            ->required()
                            ->searchable(),

                        Forms\Components\TextInput::make('judul_kegiatan')
                            ->label('Judul Kegiatan')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->placeholder('Contoh: Desain Feed Instagram Diskominfo'),

                        Forms\Components\RichEditor::make('deskripsi_kegiatan')
                            ->label('Deskripsi Detail Kegiatan')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Waktu & Status')
                    ->description('Atur jam kegiatan dan status review')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        Forms\Components\TimePicker::make('jam_mulai')
                            ->label('Jam Mulai')
                            ->required()
                            ->default('08:00'),

                        Forms\Components\TimePicker::make('jam_selesai')
                            ->label('Jam Selesai')
                            ->required()
                            ->default('16:00'),

                        Forms\Components\Select::make('mood')
                            ->label('Tingkat Kesulitan')
                            ->options(array_combine(Logbook::MOOD, Logbook::MOOD))
                            ->default('🙂 Normal'),

                        Forms\Components\Select::make('status')
                            ->label('Status Review')
                            ->options(array_combine(Logbook::STATUS, Logbook::STATUS))
                            ->default('Draft')
                            ->required(),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Dokumentasi')
                    ->description('Upload foto kegiatan pendukung')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Forms\Components\FileUpload::make('photos')
                            ->label('')
                            ->multiple()
                            ->image()
                            ->directory('logbooks')
                            ->maxSize(5120)
                            ->helperText('Bisa upload lebih dari 1 foto. Maksimal 5MB per file.')
                            ->columnSpanFull(),
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
                    ->sortable(),

                Tables\Columns\TextColumn::make('hari_ke')
                    ->label('Hari Ke-')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Mahasiswa')
                    ->sortable()
                    ->searchable()
                    ->visible(fn () => !Auth::user()->isMahasiswa()),

                Tables\Columns\TextColumn::make('judul_kegiatan')
                    ->label('Judul Kegiatan')
                    ->searchable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('kategori_kegiatan')
                    ->label('Kategori')
                    ->badge()
                    ->color('primary')
                    ->searchable(),

                Tables\Columns\TextColumn::make('mood')
                    ->label('Mood')
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Disetujui Mentor' => 'success',
                        'Menunggu Review' => 'warning',
                        'Draft' => 'gray',
                        'Revisi' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('jam_mulai')
                    ->label('Waktu')
                    ->formatStateUsing(fn ($record) => $record->jam_mulai->format('H:i') . ' - ' . $record->jam_selesai->format('H:i')),
            ])
            ->filters([
                Tables\Filters\Filter::make('tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal_dari')->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('tanggal_hingga')->label('Hingga Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['tanggal_dari'], fn (Builder $query, $date) => $query->whereDate('tanggal', '>=', $date))
                            ->when($data['tanggal_hingga'], fn (Builder $query, $date) => $query->whereDate('tanggal', '<=', $date));
                    }),

                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Mahasiswa')
                    ->relationship('user', 'name', fn (Builder $query) => $query->role('mahasiswa'))
                    ->visible(fn () => !Auth::user()->isMahasiswa()),

                Tables\Filters\SelectFilter::make('kategori_kegiatan')
                    ->label('Kategori')
                    ->options(array_combine(Logbook::KATEGORI, Logbook::KATEGORI)),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options(array_combine(Logbook::STATUS, Logbook::STATUS)),
            ])
            ->defaultSort('tanggal', 'desc')
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label('Lihat'),
                    Tables\Actions\EditAction::make()
                        ->label('Edit'),
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
            'index' => Pages\ListLogbooks::route('/'),
            'create' => Pages\CreateLogbook::route('/create'),
            'edit' => Pages\EditLogbook::route('/{record}/edit'),
            'view' => Pages\ViewLogbook::route('/{record}'),
        ];
    }
}
