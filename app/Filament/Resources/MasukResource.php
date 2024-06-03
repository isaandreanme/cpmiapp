<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MasukResource\Pages;
use App\Filament\Resources\MasukResource\RelationManagers\BukuKasRelationManager;
use App\Models\Masuk;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MasukResource extends Resource
{
    protected static ?string $model = Masuk::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';
    protected static ?string $navigationGroup = 'KEU';
    protected static ?string $navigationLabel = 'TRANSAKSI MASUK';
    protected static ?int $navigationSort = -8;
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }




    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextInput::make('nominal')
                            ->numeric(),
                            // ->currencyMask(thousandSeparator: ','),
                        // ->mask('999.999.999.999'),

                        // ->mask(fn (TextInput\Mask $mask) => $mask
                        //     ->numeric()
                        //     ->decimalPlaces(2) // Set the number of digits after the decimal point.
                        //     ->decimalSeparator(',') // Add a separator for decimal numbers.
                        //     ->integer() // Disallow decimal numbers.
                        //     ->mapToDecimalSeparator([';-']) // Map additional characters to the decimal separator.
                        //     //->minValue(1) // Set the minimum value that the number can be.
                        //     // ->maxValue(100) // Set the maximum value that the number can be.
                        //     ->normalizeZeros() // Append or remove zeros at the end of the number.
                        //     ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                        //     ->thousandsSeparator('.'), // Add a separator for thousands.
                        //         ),
                        TextInput::make('keterangan'),
                        Select::make('buku_kas_id',)
                            ->relationship('BukuKas', 'nama')
                            ->required(),
                        DatePicker::make('created_at')->native(false)->displayFormat('d/m/Y'),
                        FileUpload::make('nota')
                            ->disk('public')
                            ->directory('transaksi/nota_masuk')
                            ->preserveFilenames()
                            ->enableDownload()
                            ->enableOpen()
                            ->enableReordering()
                            ->loadingIndicatorPosition('right')
                            ->removeUploadedFileButtonPosition('right')
                            ->uploadButtonPosition('left')
                            ->uploadProgressIndicatorPosition('left'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->date()->label('Di Buat Pada'),
                TextColumn::make('nominal')->money('idr', 2),
                // ->money('idr', 2),
                TextColumn::make('keterangan'),
                TextColumn::make('BukuKas.nama')
                    ->sortable()
                    ->searchable()
                    ->alignment('left'),
                ImageColumn::make('nota')->circular(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            BukuKasRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMasuks::route('/'),
            'create' => Pages\CreateMasuk::route('/create'),
            'edit' => Pages\EditMasuk::route('/{record}/edit'),
        ];
    }
}
