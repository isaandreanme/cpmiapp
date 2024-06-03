<?php

namespace App\Filament\Resources\MasukResource\Pages;

use App\Filament\Resources\MasukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMasuk extends EditRecord
{
    protected static string $resource = MasukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
