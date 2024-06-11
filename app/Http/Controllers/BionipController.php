<?php

namespace App\Http\Controllers;

use App\Models\Bionip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BionipController extends Controller
{
    public function download(Bionip $record)
    {
        // dd($record);
        return view('bionip', compact('record'));
    }
    public function show($id)
    {
        // Path to your JSON file
        $jsonPath = storage_path('app/database.json');

        // Read and decode JSON file
        $jsonData = json_decode(file_get_contents($jsonPath), true);

        // Pass data to the view
        return view('bionip', ['record' => $jsonData['record']]);

        $biodata = Bionip::findOrFail($id);

        return view('bionip.show', compact('bionip'));
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
