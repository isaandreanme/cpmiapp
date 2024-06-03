<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarketingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('marketings')->insert([
            [ 'nama' => 'PRIVATE'],
            [ 'nama' => 'CV'],
            [ 'nama' => 'MARKETING 1'],
            [ 'nama' => 'MARKETING 2'],
            [ 'nama' => 'MARKETING 3'],
            [ 'nama' => 'MARKETING 4'],
            [ 'nama' => 'MARKETING 5'],


            ]);
    }
}
