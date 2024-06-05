<?php

namespace App\Filament\Resources\BiodataResource\Pages;

use App\Filament\Resources\BiodataResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;


class ListBiodatas extends ListRecords
{
    protected static string $resource = BiodataResource::class;

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
