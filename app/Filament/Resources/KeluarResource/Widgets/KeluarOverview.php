<?php

namespace App\Filament\Resources\KeluarResource\Widgets;

use App\Models\BukuKas;
use App\Models\Keluar;
use App\Models\Masuk;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class KeluarOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $jumlahsaldo = BukuKas::all('nominal')->sum('nominal');
        $totalmasuk = Masuk::all('nominal')->sum('nominal');
        $totalkeluar = Keluar::all('nominal')->sum('nominal');

        $totalsaldo = $jumlahsaldo + $totalmasuk - $totalkeluar;

        return [
              
            Card::make('Nominal Keluar', FormatRupiah($totalkeluar))
            ->description('Total Nominal Keluar')
            ->descriptionIcon('heroicon-o-document-minus')
            ->color('danger'),
        ];
    }
}