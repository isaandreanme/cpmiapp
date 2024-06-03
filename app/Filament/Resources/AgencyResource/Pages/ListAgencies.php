<?php

namespace App\Filament\Resources\AgencyResource\Pages;

use App\Filament\Resources\AgencyResource;
use Closure;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgencies extends ListRecords
{
    protected static string $resource = AgencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getTableRecordUrlUsing (): ?Closure
    {
        return null;
    }
    protected function getTableRecordActionUsing (): ?Closure
    {
        return null;
    }
}
