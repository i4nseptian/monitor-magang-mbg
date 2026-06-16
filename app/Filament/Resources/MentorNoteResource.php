<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MentorNoteResource\Pages;
use App\Models\MentorNote;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class MentorNoteResource extends Resource
{
    protected static ?string $model = MentorNote::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Catatan Mentor';

    protected static ?string $modelLabel = 'Catatan & Evaluasi';

    protected static ?string $pluralModelLabel = 'Catatan Mentor';

    protected static ?string $navigationGroup = 'Kegiatan Magang';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Mahasiswa Magang')
                            ->relationship('mahasiswa', 'name', fn (Builder $query) => $query->role('mahasiswa'))
                            ->required()
                            ->searchable()
                            ->preload()
                            ->disabled(fn () => Auth::user()->isMahasiswa()),

                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Tanggal Evaluasi')
                            ->default(now())
                            ->required()
                            ->disabled(fn () => Auth::user()->isMahasiswa()),

                        Forms\Components\Select::make('mentor_id')
                            ->label('Nama Mentor')
                            ->relationship('mentor', 'name', fn (Builder $query) => $query->role('mentor'))
                            ->required()
                            ->default(fn () => Auth::user()->isMentor() ? Auth::id() : null)
                            ->disabled(fn () => Auth::user()->isMahasiswa() || Auth::user()->isMentor())
                            ->dehydrated(),

                        Forms\Components\Select::make('status')
                            ->label('Status Evaluasi')
                            ->options(array_combine(MentorNote::STATUS, MentorNote::STATUS))
                            ->required()
                            ->default('Baik')
                            ->disabled(fn () => Auth::user()->isMahasiswa()),

                        Forms\Components\RichEditor::make('catatan')
                            ->label('Catatan Bimbingan / Kegiatan')
                            ->required()
                            ->columnSpanFull()
                            ->disabled(fn () => Auth::user()->isMahasiswa()),

                        Forms\Components\RichEditor::make('evaluasi')
                            ->label('Evaluasi & Saran Perbaikan')
                            ->columnSpanFull()
                            ->disabled(fn () => Auth::user()->isMahasiswa()),
                    ])
                    ->columns(2)
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

                Tables\Columns\TextColumn::make('mahasiswa.name')
                    ->label('Mahasiswa')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('mentor.name')
                    ->label('Mentor')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Sangat Baik' => 'success',
                        'Baik' => 'info',
                        'Cukup' => 'warning',
                        'Perlu Perbaikan' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('catatan')
                    ->label('Ringkasan Catatan')
                    ->html()
                    ->limit(50),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Mahasiswa')
                    ->relationship('mahasiswa', 'name', fn (Builder $query) => $query->role('mahasiswa')),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status Evaluasi')
                    ->options(array_combine(MentorNote::STATUS, MentorNote::STATUS)),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->with(['mahasiswa', 'mentor']);

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
            'index' => Pages\ListMentorNotes::route('/'),
            'create' => Pages\CreateMentorNote::route('/create'),
            'edit' => Pages\EditMentorNote::route('/{record}/edit'),
            'view' => Pages\ViewMentorNote::route('/{record}'),
        ];
    }
}
