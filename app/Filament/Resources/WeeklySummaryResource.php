<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeeklySummaryResource\Pages;
use App\Models\WeeklySummary;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class WeeklySummaryResource extends Resource
{
    protected static ?string $model = WeeklySummary::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationLabel = 'Ringkasan Mingguan';

    protected static ?string $navigationGroup = 'Monitoring';

    protected static ?int $navigationSort = 3;

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

                        Forms\Components\TextInput::make('minggu_ke')
                            ->label('Minggu Ke-')
                            ->required()
                            ->numeric()
                            ->minValue(1),

                        Forms\Components\DatePicker::make('tanggal_mulai')
                            ->label('Tanggal Mulai')
                            ->required(),

                        Forms\Components\DatePicker::make('tanggal_selesai')
                            ->label('Tanggal Selesai')
                            ->required(),

                        Forms\Components\RichEditor::make('pekerjaan')
                            ->label('Pekerjaan yang Dilakukan')
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('kendala')
                            ->label('Kendala')
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('solusi')
                            ->label('Solusi')
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('skill_dipelajari')
                            ->label('Skill yang Dipelajari')
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
                    ->visible(fn () => !Auth::user()->isMahasiswa()),

                Tables\Columns\TextColumn::make('minggu_ke')
                    ->label('Minggu Ke-')
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->label('Periode')
                    ->formatStateUsing(fn ($record) => $record->tanggal_mulai->format('d/m/Y') . ' - ' . $record->tanggal_selesai->format('d/m/Y'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('pekerjaan')
                    ->label('Pekerjaan')
                    ->html()
                    ->limit(60),
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
            'index' => Pages\ListWeeklySummaries::route('/'),
            'create' => Pages\CreateWeeklySummary::route('/create'),
            'edit' => Pages\EditWeeklySummary::route('/{record}/edit'),
            'view' => Pages\ViewWeeklySummary::route('/{record}'),
        ];
    }
}
