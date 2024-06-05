<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata;
use LaravelDaily\Invoices\Invoice;

class BIODATAController extends Controller
{
    public function download(Biodata $record)
    {
        return view('biodata', compact('record'));
    }
}
