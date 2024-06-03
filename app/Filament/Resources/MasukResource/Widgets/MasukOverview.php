<?php

namespace App\Filament\Resources\MasukResource\Widgets;

use App\Models\BukuKas;
use App\Models\Keluar;
use App\Models\Masuk;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class MasukOverview extends BaseWidget
{
    // Tables\Columns\TextColumn::make('expense_transactions_sum_amount')->sum('expense_transactions', 'amount')->money('USD', 2)->label('Amount'),
    protected function getCards(): array
    {
        $jumlahsaldo = BukuKas::all('nominal')->sum('nominal');
        $totalmasuk = Masuk::all('nominal')->sum('nominal');
        $totalkeluar = Keluar::all('nominal')->sum('nominal');

        $totalsaldo = $jumlahsaldo + $totalmasuk - $totalkeluar;

        return [
        
            Card::make('Nominal Masuk', FormatRupiah($totalmasuk))
            ->description('Total Nominal Masuk')
            ->descriptionIcon('heroicon-o-document-plus')
            ->color('success'),
            
        ];
    }
}
