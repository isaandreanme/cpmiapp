<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendaftaranResource\RelationManagers\DataPmiRelationManager;
use App\Filament\Resources\StatusResource\Pages;
use App\Filament\Resources\StatusResource\RelationManagers;
use App\Models\Status;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StatusResource extends Resource
{
    protected static ?string $model = Status::class;

    protected static ?string $navigationIcon = 'heroicon-s-squares-plus';
    protected static ?string $navigationGroup = 'MODUL';
    protected static ?string $navigationLabel = 'STATUS';
    protected static ?int $navigationSort = 3;
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(
                null
            )
            ->paginated([12, 25, 50, 100, 'all'])
            ->contentGrid([
                'md' => 2,
                'xl' => 4,
            ])
            ->columns([
                Stack::make([
                    // TextColumn::make('id')->label('ID'),
                    TextColumn::make('nama')->label('STATUS'),
                ])
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),

                ])
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

    public static function getRelations(): array
    {
        return [
            DataPmiRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStatuses::route('/'),
            'create' => Pages\CreateStatus::route('/create'),
            'edit' => Pages\EditStatus::route('/{record}/edit'),
            'view' => Pages\ViewStatus::route('/{record}'),

        ];
    }
}
