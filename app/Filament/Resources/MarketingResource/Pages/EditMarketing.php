<?php

namespace App\Filament\Resources\MarketingResource\Pages;

use App\Filament\Resources\MarketingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMarketing extends EditRecord
{
    protected static string $resource = MarketingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
