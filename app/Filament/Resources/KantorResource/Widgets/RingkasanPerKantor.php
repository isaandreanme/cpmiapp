<?php

namespace App\Filament\Resources\KantorResource\Widgets;

use Kenepa\MultiWidget\MultiWidget;

class RingkasanPerKantor extends MultiWidget
{
    public array $widgets = [

        Kendal::class,
        Batang::class,
        Brebes::class,
        Pati::class,


    ];
}
