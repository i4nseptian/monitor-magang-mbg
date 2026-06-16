<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoginHistoryResource\Pages;
use App\Models\LoginHistory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class LoginHistoryResource extends Resource
{
    protected static ?string $model = LoginHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $navigationLabel = 'Riwayat Login';

    protected static ?string $modelLabel = 'Riwayat Login';

    protected static ?string $pluralModelLabel = 'Riwayat Login';

    protected static ?string $navigationGroup = 'Sistem & Keamanan';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')->disabled(),
                Forms\Components\TextInput::make('ip_address')->disabled(),
                Forms\Components\DateTimePicker::make('login_at')->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pengguna')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP Address'),

                Tables\Columns\TextColumn::make('login_at')
                    ->label('Waktu Login')
                    ->dateTime('d M Y, H:i:s')
                    ->sortable(),
            ])
            ->defaultSort('login_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Pengguna')
                    ->relationship('user', 'name'),
            ])
            ->defaultSort('login_at', 'desc')
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label('Lihat'),
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

    public static function canCreate(): bool
    {
        return false; // Login histories are system-generated only
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLoginHistories::route('/'),
        ];
    }
}
