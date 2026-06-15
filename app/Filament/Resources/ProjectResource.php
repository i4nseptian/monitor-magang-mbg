<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel = 'Project Showcase';

    protected static ?string $navigationGroup = 'Portfolio';

    protected static ?int $navigationSort = 1;

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

                        Forms\Components\TextInput::make('judul')
                            ->label('Nama Project')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Dashboard Monitoring Magang'),

                        Forms\Components\TextInput::make('teknologi')
                            ->label('Teknologi')
                            ->maxLength(255)
                            ->placeholder('Contoh: Laravel, MySQL, Bootstrap, Chart.js'),

                        Forms\Components\Select::make('status_project')
                            ->label('Status Project')
                            ->options(array_combine(Project::STATUS_PROJECT, Project::STATUS_PROJECT))
                            ->required()
                            ->default('Sedang Dikerjakan'),

                        Forms\Components\TextInput::make('link')
                            ->label('Link Project (Opsional)')
                            ->maxLength(255)
                            ->url()
                            ->placeholder('https://github.com/username/project'),

                        Forms\Components\RichEditor::make('deskripsi')
                            ->label('Deskripsi Project')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('screenshot')
                            ->label('Screenshot Project')
                            ->image()
                            ->directory('projects')
                            ->maxSize(5120)
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

                Tables\Columns\TextColumn::make('judul')
                    ->label('Project')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('teknologi')
                    ->label('Teknologi')
                    ->badge()
                    ->color('info')
                    ->searchable(),

                Tables\Columns\TextColumn::make('status_project')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Selesai' => 'success',
                        'Sedang Dikerjakan' => 'warning',
                        'Ditunda' => 'danger',
                        'Dibatalkan' => 'gray',
                        default => 'gray',
                    }),

                Tables\Columns\ImageColumn::make('screenshot')
                    ->label('Screenshot')
                    ->circular()
                    ->size(60),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_project')
                    ->label('Status')
                    ->options(array_combine(Project::STATUS_PROJECT, Project::STATUS_PROJECT)),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
            'view' => Pages\ViewProject::route('/{record}'),
        ];
    }
}
