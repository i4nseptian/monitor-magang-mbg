<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillDevelopmentResource\Pages;
use App\Models\SkillDevelopment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class SkillDevelopmentResource extends Resource
{
    protected static ?string $model = SkillDevelopment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationLabel = 'Skill Development';

    protected static ?string $navigationGroup = 'Kegiatan Magang';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
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

                        Forms\Components\TextInput::make('skill_name')
                            ->label('Nama Skill')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: UI/UX Design, Laravel, Database'),

                        Forms\Components\TextInput::make('nilai_awal')
                            ->label('Nilai Awal Magang (0-100)')
                            ->numeric()
                            ->required()
                            ->minValue(0)
                            ->maxValue(100)
                            ->suffix('%'),

                        Forms\Components\TextInput::make('nilai_akhir')
                            ->label('Nilai Akhir Magang (0-100)')
                            ->numeric()
                            ->nullable()
                            ->minValue(0)
                            ->maxValue(100)
                            ->suffix('%'),

                        Forms\Components\Textarea::make('catatan')
                            ->label('Catatan')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Mahasiswa')
                    ->sortable()
                    ->searchable()
                    ->visible(fn () => !Auth::user()->isMahasiswa()),

                Tables\Columns\TextColumn::make('skill_name')
                    ->label('Skill')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nilai_awal')
                    ->label('Awal')
                    ->suffix('%')
                    ->color('warning')
                    ->sortable(),

                Tables\Columns\TextColumn::make('nilai_akhir')
                    ->label('Akhir')
                    ->suffix('%')
                    ->color('success')
                    ->sortable(),

                Tables\Columns\TextColumn::make('progress')
                    ->label('Progress')
                    ->state(fn ($record) => $record->nilai_akhir ? number_format((($record->nilai_akhir - $record->nilai_awal) / max($record->nilai_awal, 1)) * 100, 0) . '%' : '-')
                    ->color(fn ($record) => $record->nilai_akhir ? 'success' : 'gray'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Mahasiswa')
                    ->relationship('user', 'name', fn (Builder $query) => $query->role('mahasiswa'))
                    ->visible(fn () => !Auth::user()->isMahasiswa()),
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
        $query = parent::getEloquentQuery()->with(['user']);
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
            'index' => Pages\ListSkillDevelopments::route('/'),
            'create' => Pages\CreateSkillDevelopment::route('/create'),
            'edit' => Pages\EditSkillDevelopment::route('/{record}/edit'),
        ];
    }
}
