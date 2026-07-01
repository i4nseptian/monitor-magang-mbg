<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Models\Member;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Anggota Magang';

    protected static ?string $modelLabel = 'Anggota Magang';

    protected static ?string $pluralModelLabel = 'Anggota Magang';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        // Relation to User
                        Forms\Components\Select::make('user_id')
                            ->label('Nama Akun / Email')
                            ->relationship('user', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->helperText('Hubungkan profil anggota dengan akun user login.'),

                        Forms\Components\TextInput::make('nim')
                            ->label('NIM')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20),

                        Forms\Components\TextInput::make('program_studi')
                            ->label('Program Studi')
                            ->default('Bisnis Digital')
                            ->required()
                            ->maxLength(100),

                        Forms\Components\TextInput::make('divisi')
                            ->label('Divisi Penempatan')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Contoh: Pengolahan Data & Statistik'),

                        Forms\Components\TextInput::make('no_hp')
                            ->label('Nomor HP')
                            ->tel()
                            ->required()
                            ->maxLength(20),

                        Forms\Components\DatePicker::make('tanggal_mulai')
                            ->label('Mulai Magang')
                            ->default(config('intern.default_tanggal_mulai'))
                            ->required(),

                        Forms\Components\DatePicker::make('tanggal_selesai')
                            ->label('Selesai Magang')
                            ->default(config('intern.default_tanggal_selesai'))
                            ->required(),

                        Forms\Components\FileUpload::make('foto_profil')
                            ->label('Foto Profil')
                            ->image()
                            ->avatar()
                            ->directory('profiles')
                            ->imageResizeMode('force')
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('200')
                            ->imageResizeTargetHeight('200')
                            ->maxSize(2048)
                            ->rules(['mimetypes:image/jpeg,image/png,image/webp'])
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto_profil')
                    ->label('Foto')
                    ->circular(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nim')
                    ->label('NIM')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('divisi')
                    ->label('Divisi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('no_hp')
                    ->label('No. HP'),

                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->label('Mulai')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('divisi')
                    ->label('Divisi')
                    ->options([
                        'Publikasi & Hubungan Masyarakat' => 'Publikasi & Humas',
                        'Pengolahan Data & Statistik' => 'Pengolahan Data & Statistik',
                        'Desain Kreatif & Multimedia' => 'Desain Kreatif & Multimedia',
                        'Infrastruktur & Layanan Digital' => 'Infrastruktur & Layanan Digital',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\ActionGroup::make([
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
        return parent::getEloquentQuery()->with(['user']);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
