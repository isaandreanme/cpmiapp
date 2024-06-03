<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(IndoRegionSeeder::class);
        $this->call(AgencySeeder::class);
        $this->call(KantorSeeder::class);
        $this->call(MarketingSeeder::class);
        $this->call(PengalamanSeeder::class);
        $this->call(SponsorSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(TujuanSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
