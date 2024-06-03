<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KantorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kantors')->insert([
            [ 'nama' => 'KANTOR 1'],
            [ 'nama' => 'KANTOR 2'],
            [ 'nama' => 'KANTOR 3'],
            [ 'nama' => 'KANTOR 4'],
        ]);
    }
}
