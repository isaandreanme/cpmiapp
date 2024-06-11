<?php

namespace App\Filament\Resources\BionipResource\Pages;

use App\Filament\Resources\BionipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBionips extends ListRecords
{
    protected static string $resource = BionipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
