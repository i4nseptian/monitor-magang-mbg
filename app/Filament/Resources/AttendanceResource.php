<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceResource\Pages;
use App\Models\Attendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationLabel = 'Kehadiran';

    protected static ?string $navigationGroup = 'Kegiatan Magang';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Nama Mahasiswa')
                            ->relationship('user', 'name', fn (Builder $query) => $query->mahasiswa())
                            ->required()
                            ->searchable()
                            ->preload()
                            ->default(fn () => Auth::user()->isMahasiswa() ? Auth::id() : null)
                            ->disabled(fn () => Auth::user()->isMahasiswa())
                            ->dehydrated(),

                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Tanggal')
                            ->default(now())
                            ->required(),

                        Forms\Components\TimePicker::make('check_in')
                            ->label('Jam Masuk (Check-in)')
                            ->default('08:00')
                            ->required(),

                        Forms\Components\TimePicker::make('check_out')
                            ->label('Jam Pulang (Check-out)')
                            ->default('16:00'),

                        Forms\Components\Select::make('status')
                            ->label('Status Kehadiran')
                            ->options([
                                'Hadir' => 'Hadir',
                                'Izin' => 'Izin',
                                'Sakit' => 'Sakit',
                                'Alpha' => 'Alpha',
                                'Cuti' => 'Cuti',
                            ])
                            ->required()
                            ->default('Hadir'),

                        Forms\Components\Textarea::make('keterangan')
                            ->label('Keterangan')
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

                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('check_in')
                    ->label('Check-in')
                    ->time('H:i'),

                Tables\Columns\TextColumn::make('check_out')
                    ->label('Check-out')
                    ->time('H:i'),

                Tables\Columns\TextColumn::make('total_jam')
                    ->label('Total Jam')
                    ->state(fn ($record) => $record->total_jam),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Hadir' => 'success',
                        'Izin' => 'warning',
                        'Sakit' => 'info',
                        'Alpha' => 'danger',
                        'Cuti' => 'gray',
                        default => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Mahasiswa')
                    ->relationship('user', 'name', fn (Builder $query) => $query->mahasiswa())
                    ->visible(fn () => !Auth::user()->isMahasiswa()),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'Hadir' => 'Hadir',
                        'Izin' => 'Izin',
                        'Sakit' => 'Sakit',
                        'Alpha' => 'Alpha',
                        'Cuti' => 'Cuti',
                    ]),

                Tables\Filters\Filter::make('tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal_dari')
                            ->label('Dari Tanggal')
                            ->native(false),
                        Forms\Components\DatePicker::make('tanggal_hingga')
                            ->label('Hingga Tanggal')
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['tanggal_dari'], fn (Builder $query, $date) => $query->whereDate('tanggal', '>=', $date))
                            ->when($data['tanggal_hingga'], fn (Builder $query, $date) => $query->whereDate('tanggal', '<=', $date));
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data['tanggal_dari'] && !$data['tanggal_hingga']) return null;
                        $dari = $data['tanggal_dari'] ? \Carbon\Carbon::parse($data['tanggal_dari'])->format('d/m/Y') : '...';
                        $hingga = $data['tanggal_hingga'] ? \Carbon\Carbon::parse($data['tanggal_hingga'])->format('d/m/Y') : '...';
                        return "{$dari} – {$hingga}";
                    }),

                Tables\Filters\SelectFilter::make('preset')
                    ->label('Rentang')
                    ->options([
                        'hari_ini' => 'Hari Ini',
                        '7_hari' => '7 Hari Terakhir',
                        '30_hari' => '30 Hari Terakhir',
                        'bulan_ini' => 'Bulan Ini',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return match ($data['value'] ?? null) {
                            'hari_ini' => $query->whereDate('tanggal', now()),
                            '7_hari' => $query->where('tanggal', '>=', now()->subDays(7)),
                            '30_hari' => $query->where('tanggal', '>=', now()->subDays(30)),
                            'bulan_ini' => $query->whereMonth('tanggal', now()->month)->whereYear('tanggal', now()->year),
                            default => $query,
                        };
                    }),
            ])
            ->defaultSort('tanggal', 'desc')
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
            'index' => Pages\ListAttendances::route('/'),
            'create' => Pages\CreateAttendance::route('/create'),
            'edit' => Pages\EditAttendance::route('/{record}/edit'),
        ];
    }
}
