<?php

namespace App\Filament\Resources\MasukResource\Pages;

use App\Filament\Resources\MasukResource;
use App\Filament\Resources\MasukResource\Widgets\MasukOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMasuks extends ListRecords
{
    protected static string $resource = MasukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            MasukOverview::class
        ];
    }
}
