<?php

namespace App\Filament\Resources\DataPmiResource\Pages;

use App\Filament\Resources\DataPmiResource;
use App\Models\DataPmi;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\View\View;
use Filament\Resources\Pages\EditRecord;


class ViewDataPmi extends ViewRecord
{
    protected static string $resource = DataPmiResource::class;

    protected static string $view = 'filament.resources.datapmi.view';
    public function getFooter(): ?View
    {
        return view('filament.settings.custom-footer');
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->label('Update'),
            Action::make('Download Pdf')
                ->label('Cetak')
                ->icon('heroicon-o-printer')
                ->url(fn (DataPmi $record) => route('datapmi.pdf.download', $record))
                ->openUrlInNewTab(),
        ];
    }
}
