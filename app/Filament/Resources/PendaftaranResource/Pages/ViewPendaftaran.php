<?php

namespace App\Filament\Resources\PendaftaranResource\Pages;

use App\Filament\Resources\PendaftaranResource;
use App\Models\Pendaftaran;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\View\View;

class ViewPendaftaran extends ViewRecord
{
    protected static string $resource = PendaftaranResource::class;
    public function getFooter(): ?View
    {
        return view('filament.settings.custom-footer');
    }
    public static function getGlobalSearchResultTitle(Pendaftaran $record): string
    {
        return $record->nama;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->label('Update'),
            
        ];
    }
}
