<?php

namespace App\Http\Controllers;

use App\Models\DataPmi;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;

class DownloadPdfController extends Controller
{
    public function download(DataPmi $record)
    {
        return view('data-pmi', compact('record'));
    }
    public function downloads(Pendaftaran $record)
    {
        return view('pendaftaran', compact('record'));
    }
}
