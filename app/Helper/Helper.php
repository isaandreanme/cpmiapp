<?php

    function FormatRupiah($nominal, $prefix = null)
    {
        $prefix = $prefix ? $prefix : 'Rp.';
        return $prefix . number_format($nominal, 0,',','.');

    }
