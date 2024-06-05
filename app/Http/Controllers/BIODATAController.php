<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata;
use Illuminate\Support\Facades\Storage;


class BIODATAController extends Controller
{
    public function download(Biodata $record)
    {
        // dd($record);
        return view('biodata', compact('record'));
    }
    public function show($id)
    {
        // Path to your JSON file
        $jsonPath = storage_path('app/database.json');

        // Read and decode JSON file
        $jsonData = json_decode(file_get_contents($jsonPath), true);

        // Pass data to the view
        return view('biodata', ['record' => $jsonData['record']]);

        $biodata = Biodata::findOrFail($id);

        return view('biodata.show', compact('biodata'));
    }


    public function showPhoto($filename)
    {
        $path = 'biodata/foto/' . $filename;

        if (Storage::exists($path)) {
            $file = Storage::get($path);
            $type = Storage::mimeType($path);
            $response = response($file, 200)->header('Content-Type', $type);
            return $response;
        }

        abort(404);
    }
}
