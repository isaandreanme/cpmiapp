<?php

namespace App\Filament\Resources\MasukResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BukuKasRelationManager extends RelationManager
{
    protected static string $relationship = 'BukuKas';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama'),
                TextInput::make('nominal')
                    ->numeric()
                    ->mask('999.999.999.999'),
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
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('bukukas')
            ->columns([
                TextColumn::make('created_at')->date()->label('Di Buat Pada'),
                TextColumn::make('nama'),
                TextColumn::make('nominal')->money('idr', 2),
                TextColumn::make('keterangan'),            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
}
