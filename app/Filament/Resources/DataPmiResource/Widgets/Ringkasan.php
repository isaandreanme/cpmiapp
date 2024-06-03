<?php

namespace App\Filament\Resources\DataPmiResource\Widgets;

use App\Models\DataPmi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Ringkasan extends BaseWidget
{
    public function getColumns(): int
    {
        return 4;
    }

    protected function getStats(): array
    {
        $DATAPMI = DataPmi::all()->where('status_id', '2')->count();
        $NEW = DataPmi::all()->where('status_id', '1')->count();
        $MEDICAL = DataPmi::where('medical_check', '1')->where('status_id', '2')->count();

        $NONJOB = DataPmi::where('job', '0')->where('status_id', '2')->count();
        $JOB = DataPmi::where('job', '1')->where('status_id', '2')->count();

        $PMIFINISH = DataPmi::where('status_id', '4')->count();
        $PMIMD = DataPmi::where('status_id', '6')->count();
        $PMIPENDING = DataPmi::where('status_id', '5')->count();
        $FIT = DataPmi::where('fit', '1')->where('status_id', '2')->count();
        $UNFIT = DataPmi::where('fit', '0')->where('status_id', '2')->count();
        $TERBANG = DataPmi::where('status_id', '3')->count();

        $TERDAFTARSIAPKERJA = DataPmi::where('siapkerja', '1')->where('status_id', '2')->count();
        $VERDATA = DataPmi::where('verdata', '1')->where('status_id', '2')->count();
        $VERPP = DataPmi::where('verpp', '1')->where('status_id', '2')->count();

        //----------------------------------------------------------------

        $jumlahDataPmi = DataPmi::all()->count();
        $PMIMD = DataPmi::where('status_id', '6')->count();
        $TERBANG = DataPmi::where('status_id', '3')->count();
        $UNFIT = DataPmi::where('fit', '0')->count();
        // $TERDAFTARSIAPKERJA = DataPmi::where('siapkerja', '1')->count();

        $MARKET = DataPmi::all()->where('status_id', '2')->where('agency_id', '1')->count();
        $NONMARKET = DataPmi::all()->where('status_id', '2')->where('agency_id', '22')->count();



        $DIPROSES = $DATAPMI;
        $TOTALJOB = $JOB;
        $TOTALNONJOB = $NONJOB;

        $TOTALSIAPKERJA = $TERDAFTARSIAPKERJA;
        $TOTALVERDATA = $VERDATA;
        $TOTALVERPP = $VERPP;
        $TOTALMEDICAL = $MEDICAL;
        function generateRandomChartData($count)
        {
            $data = [];
            for ($i = 0; $i < $count; $i++) {
                $data[] = rand(5, 96);
            }
            return $data;
        }

        return [

            Stat::make('BARU', $NEW)
                ->description('Total CPMI Baru')
                ->descriptionIcon('heroicon-o-check-badge')
                ->color('primary')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/data-pmis?tableFilters[Status][values][0]=1', '_blank')",
                ])
                ->chart(generateRandomChartData(9)), // Replace 7 with the desired number of data points,

            Stat::make('DIPROSES', $DIPROSES)
                ->description('Total CPMI Di Proses')
                ->descriptionIcon('heroicon-o-clipboard-document-list')
                ->color('primary')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/data-pmis?tableFilters[Status][values][0]=2', '_blank')",
                ])
                ->chart(generateRandomChartData(9)), // Replace 7 with the desired number of data points,


            Stat::make('SUDAH MARKET', $MARKET)
                ->description('Total CPMI On Market')
                ->descriptionIcon('heroicon-o-shopping-cart')
                ->color('success')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/data-pmis?tableFilters[Status][values][0]=2&tableFilters[Agency][value]=1', '_blank')",
                ])
                ->chart(generateRandomChartData(9)), // Replace 7 with the desired number of data points,

            Stat::make('BELUM MARKET', $NONMARKET)
                ->description('Total CPMI Belum Market')
                ->descriptionIcon('heroicon-o-flag')
                ->color('warning')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/data-pmis?tableFilters[Status][values][0]=2&tableFilters[Agency][value]=22', '_blank')",
                ])
                ->chart(generateRandomChartData(9)), // Replace 7 with the desired number of data points,

            Stat::make('DAPAT JOB', $TOTALJOB)
                ->description('Total CPMI Sudah Dapat JOB')
                ->descriptionIcon('heroicon-o-key')
                ->color('success')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/data-pmis?tableFilters[Status][values][0]=2&tableFilters[job][value]=1', '_blank')",
                ])
                ->chart(generateRandomChartData(9)), // Replace 7 with the desired number of data points,

            Stat::make('BELUM JOB', $TOTALNONJOB)
                ->description('Total CPMI Belum Dapat JOB')
                ->descriptionIcon('heroicon-o-arrows-right-left')
                ->color('warning')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/data-pmis?tableFilters[Status][values][0]=2&tableFilters[job][value]=0', '_blank')",
                ])
                ->chart(generateRandomChartData(9)), // Replace 7 with the desired number of data points,

            Stat::make('SIAPKERJA', $TERDAFTARSIAPKERJA)
                ->description('Total CPMI Terdaftar SiapKerja')
                ->descriptionIcon('heroicon-o-check-badge')
                ->color('primary')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/data-pmis?tableFilters[Status][values][0]=2&tableFilters[siapkerja][value]=1', '_blank')",
                ])
                ->chart(generateRandomChartData(9)), // Replace 7 with the desired number of data points,

            Stat::make('ID SISKO BP2MI', $VERPP)
                ->description('Total CPMI Sudah ID')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('primary')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/data-pmis?tableFilters[Status][values][0]=2&tableFilters[verpp][value]=1', '_blank')",
                ])
                ->chart(generateRandomChartData(9)), // Replace 7 with the desired number of data points,

            Stat::make('TERBANG', $TERBANG)
                ->description('Penerbangan Bulan Ini')
                ->descriptionIcon('heroicon-o-globe-asia-australia')
                ->color('success')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/data-pmis?tableFilters[Status][values][0]=3', '_blank')",
                ])
                ->chart(generateRandomChartData(9)), // Replace 7 with the desired number of data points,

            Stat::make('FINISH', $PMIFINISH)
                ->description('Total CPMI Finish')
                ->descriptionIcon('heroicon-o-star')
                ->color('success')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/data-pmis?tableFilters[Status][values][0]=4', '_blank')",
                ])
                ->chart(generateRandomChartData(9)), // Replace 7 with the desired number of data points,

            Stat::make('PENDING', $PMIPENDING)
                ->description('Total CPMI Pending')
                ->descriptionIcon('heroicon-o-clock')
                ->color('danger')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/data-pmis?tableFilters[Status][values][0]=5', '_blank')",
                ])
                ->chart(generateRandomChartData(9)), // Replace 7 with the desired number of data points,

            Stat::make('MD', $PMIMD)
                ->description('Total CPMI Mengundurkan Diri')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/data-pmis?tableFilters[Status][values][0]=6', '_blank')",
                ])
                ->chart(generateRandomChartData(9)), // Replace 7 with the desired number of data points,

        ];
    }
}
