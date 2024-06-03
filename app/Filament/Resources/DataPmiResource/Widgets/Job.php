<?php

namespace App\Filament\Resources\DataPmiResource\Widgets;

use App\Models\DataPmi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Job extends BaseWidget
{
    public function getColumns(): int
    {
        return 4;
    }

    protected function getStats(): array
    {
        

        $JOBHK = DataPmi::all()->where('status_id', '2')->where('tujuan_id', '2')->where('job', '1')->count();
        $JOBTW = DataPmi::all()->where('status_id', '2')->where('tujuan_id', '1')->where('job', '1')->count();
        $JOBSGP = DataPmi::all()->where('status_id', '2')->where('tujuan_id', '3')->where('job', '1')->count();
        $JOBMY = DataPmi::all()->where('status_id', '2')->where('tujuan_id', '4')->where('job', '1')->count();

        $NONJOBHK = DataPmi::all()->where('status_id', '2')->where('tujuan_id', '2')->where('job', '0')->count();
        $NONJOBTW = DataPmi::all()->where('status_id', '2')->where('tujuan_id', '1')->where('job', '0')->count();
        $NONJOBSGP = DataPmi::all()->where('status_id', '2')->where('tujuan_id', '3')->where('job', '0')->count();
        $NONJOBMY = DataPmi::all()->where('status_id', '2')->where('tujuan_id', '4')->where('job', '0')->count();


        function generateRandomChartData($count)
        {
            $data = [];
            for ($i = 0; $i < $count; $i++) {
                $data[] = rand(5, 96);
            }
            return $data;
        }

        return [

            Stat::make('HONG KONG', $JOBHK)
                ->description('CPMI Sudah Dapat JOB')
                ->descriptionIcon('heroicon-o-check-badge')
                ->color('success')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/data-pmis?tableFilters[Status][values][0]=2&tableFilters[Tujuan][value]=2&tableFilters[job][value]=1')",
                ]),
                // ->chart(generateRandomChartData(9)), // Replace 7 with the desired number of data points,

            Stat::make('TAIWAN', $JOBTW)
                ->description('CPMI Sudah Dapat JOB')
                ->descriptionIcon('heroicon-o-check-badge')
                ->color('success')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/data-pmis?tableFilters[Status][values][0]=2&tableFilters[Tujuan][value]=1&tableFilters[job][value]=1')",
                ]),
                // ->chart(generateRandomChartData(9)), // Replace 7 with the desired number of data points,


            Stat::make('SINGAPURA', $JOBSGP)
                ->description('CPMI Sudah Dapat JOB')
                ->descriptionIcon('heroicon-o-check-badge')
                ->color('success')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/data-pmis?tableFilters[Status][values][0]=2&tableFilters[Tujuan][value]=3&tableFilters[job][value]=1')",
                ]),
                // ->chart(generateRandomChartData(9)), // Replace 7 with the desired number of data points,

            Stat::make('MALAYSIA', $JOBMY)
                ->description('CPMI Sudah Dapat JOB')
                ->descriptionIcon('heroicon-o-check-badge')
                ->color('success')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/data-pmis?tableFilters[Status][values][0]=2&tableFilters[Tujuan][value]=4&tableFilters[job][value]=1')",
                ]),
                // ->chart(generateRandomChartData(9)), // Replace 7 with the desired number of data points,

            Stat::make('HONG KONG', $NONJOBHK)
                ->description('CPMI Belum Dapat JOB')
                ->descriptionIcon('heroicon-o-clock')
                ->color('danger')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/data-pmis?tableFilters[Status][values][0]=2&tableFilters[Tujuan][value]=2&tableFilters[job][value]=0')",
                ]),
                // ->chart(generateRandomChartData(9)), // Replace 7 with the desired number of data points,

            Stat::make('TAIWAN', $NONJOBTW)
                ->description('CPMI Belum Dapat JOB')
                ->descriptionIcon('heroicon-o-clock')
                ->color('danger')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/data-pmis?tableFilters[Status][values][0]=2&tableFilters[Tujuan][value]=1&tableFilters[job][value]=0')",
                ]),
                // ->chart(generateRandomChartData(9)), // Replace 7 with the desired number of data points,

            Stat::make('SINGAPURA', $NONJOBSGP)
                ->description('CPMI Belum Dapat JOB')
                ->descriptionIcon('heroicon-o-clock')
                ->color('danger')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/data-pmis?tableFilters[Status][values][0]=2&tableFilters[Tujuan][value]=3&tableFilters[job][value]=0')",
                ]),
                // ->chart(generateRandomChartData(9)), // Replace 7 with the desired number of data points,

            Stat::make('MALAYSIA', $NONJOBMY)
                ->description('CPMI Belum Dapat JOB')
                ->descriptionIcon('heroicon-o-clock')
                ->color('danger')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/data-pmis?tableFilters[Status][values][0]=2&tableFilters[Tujuan][value]=4&tableFilters[job][value]=0')",
                ]),
                // ->chart(generateRandomChartData(9)), // Replace 7 with the desired number of data points,

        ];
    }
}
