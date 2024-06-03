<?php

namespace App\Filament\Resources\PendaftaranResource\Widgets;

use App\Models\DataPmi;
use App\Models\Pendaftaran;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;


class PendaftaranOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // $NONJOB = DataPmi::where('job','0')->count();
        // $JOB = DataPmi::where('job','1')->count(); 
        // $PMIFinish = DataPmi::where('status_id','4')->count();
        // $PMIMD = DataPmi::where('status_id','6')->count();
        // $PMIPending = DataPmi::where('status_id','5')->count();
        // $UNFIT = DataPmi::where('fit','0')->count();
        // $DATAPMI = DataPmi::all()->count();
        // $TERBANG = DataPmi::where('status_id','3')->count();

        // $DIPROSES = $DATAPMI - $PMIMD - $PMIPending - $UNFIT - $TERBANG - $PMIFinish;
        // $TotalJob = $DATAPMI - $JOB- $PMIMD - $PMIPending - $UNFIT - $TERBANG - $PMIFinish;
        // // $TotalJob = $JOB - $PMIMD - $PMIPending - $UNFIT - $TERBANG - $PMIFinish;
        // $TotalNonJob = $DATAPMI - $NONJOB;
        // $medical = DataPmi::where('medical_check','1')->count();

        $DATAPMI = DataPmi::all()->count();
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

        $DIPROSES = $DATAPMI;
        $TOTALJOB = $JOB;
        $TOTALNONJOB = $NONJOB;

        $TOTALSIAPKERJA = $TERDAFTARSIAPKERJA;
        $TOTALVERDATA = $VERDATA;
        $TOTALVERPP = $VERPP;
        $TOTALMEDICAL = $FIT;

        return [

            Stat::make('PENDAFTARAN', Pendaftaran::all()->count())
                ->description('TOTAL PENDAFTARAN')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('primary')
                ->chart([7, 10, 58, 3, 15, 50, 60]),

            Stat::make('DATA PMI', DataPmi::all()->count())
                ->description('TOTAL PMI DIPROSES')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('primary')
                ->chart([7, 10, 58, 3, 15, 50, 60]),

            Stat::make('PENERBANGAN', ($TERBANG))
                ->description('PMI TERBANG BULAN INI')
                ->descriptionIcon('heroicon-m-globe-asia-australia')
                ->color('success')
                ->chart([80, 10, 58, 80, 15, 80, 90]),

            Stat::make('PMI FINISH', ($PMIFINISH))
                ->description('TOTAL PENERBANGAN')
                ->descriptionIcon('heroicon-m-folder-open')
                ->color('primary')
                ->chart([7, 10, 45, 60, 80, 90, 100]),

        ];
    }
}
