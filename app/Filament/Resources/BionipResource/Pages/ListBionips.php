<?php

namespace App\Filament\Resources\BionipResource\Pages;

use App\Filament\Resources\BionipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;

class ListBionips extends ListRecords
{
    protected static string $resource = BionipResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->icon('heroicon-m-finger-print')
                ->label('BIODATA BARU +'),
        ];
    }
    protected ?string $heading = 'BIODATA';
    protected ?string $subheading = 'List BIODATA';
    public function getFooter(): ?View
    {
        return view('filament.settings.custom-footer');
    }
}
