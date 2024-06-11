<?php

namespace App\Filament\Resources\BionipResource\Pages;

use App\Filament\Resources\BionipResource;
use App\Models\Bionip;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewBionip extends ViewRecord
{
    protected static string $resource = BionipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Action::make('Download Pdf')
            ->label('Cetak')
            ->icon('heroicon-o-printer')
            ->url(fn (Bionip $record) => route('bionip.pdf.download', $record))
            // ->url(fn() => route('biodata.pdf'))
            ->openUrlInNewTab(),
        ];
    }
}
