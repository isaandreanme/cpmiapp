<?php

namespace App\Filament\Resources\BukuKasResource\Widgets;

use App\Models\BukuKas;
use App\Models\Keluar;
use App\Models\Masuk;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;
use PHPUnit\Framework\Constraint\Count;

class BukuKasOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $jumlahsaldo = BukuKas::all('nominal')->sum('nominal');
        $totalmasuk = Masuk::all('nominal')->sum('nominal');
        $totalkeluar = Keluar::all('nominal')->sum('nominal');

        $totalsaldo = $jumlahsaldo + $totalmasuk - $totalkeluar;

        return [
                        
            Card::make('Total Saldo', FormatRupiah($totalsaldo))
            ->description('Total Saldo')
            ->descriptionIcon('heroicon-o-banknotes'),

            Card::make('Nominal Masuk', FormatRupiah($totalmasuk))
            ->description('Total Nominal Masuk')
            ->descriptionIcon('heroicon-o-document-plus')
            ->color('success'),
            
            Card::make('Nominal Keluar', FormatRupiah($totalkeluar))
            ->description('Total Nominal Keluar')
            ->descriptionIcon('heroicon-o-document-minus')
            ->color('danger'),
        ];
    }
}
