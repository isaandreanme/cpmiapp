<?php

namespace App\Filament\Resources\BionipResource\Pages;

use App\Filament\Resources\BionipResource;
use App\Models\Bionip;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

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
    public function getTabs(): array
    {
        return [
            'NON JOB' => Tab::make('NON JOB')
                ->badge(Bionip::query()->where('dapatjob', 'NO')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('dapatjob', 'NO')),
            'JOB' => Tab::make('JOB')
                ->badge(Bionip::query()->where('dapatjob', 'YES')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('dapatjob', 'YES')),
            'ALL' => Tab::make('SEMUA')
                ->icon('heroicon-m-user-group')
                ->badge(Bionip::query()->count()),

        ];
    }
    public function getDefaultActiveTab(): string | int | null
    {
        return 'NON JOB';
    }
}
