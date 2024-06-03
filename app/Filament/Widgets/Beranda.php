<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\DataPmiResource\Widgets\Ringkasan;
use App\Filament\Resources\KantorResource\Widgets\RingkasanPerKantor;
use Kenepa\MultiWidget\MultiWidget;

class Beranda extends MultiWidget
{
    public array $widgets = [

        Ringkasan::class,
        RingkasanPerKantor::class,
        
    ];

    public function shouldPersistMultiWidgetTabsInSession(): bool
    {
        return true;
    }

}
