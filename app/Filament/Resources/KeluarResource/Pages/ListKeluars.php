<?php

namespace App\Filament\Resources\KeluarResource\Pages;

use App\Filament\Resources\KeluarResource;
use App\Filament\Resources\KeluarResource\Widgets\KeluarOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKeluars extends ListRecords
{
    protected static string $resource = KeluarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            KeluarOverview::class
        ];
    }
}
