<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Veda;
use Illuminate\Support\Facades\File;

class VedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('data/vedas.json');
        $vedas = json_decode(File::get($jsonPath), true);

        foreach ($vedas as $vedaData) {
            Veda::create($vedaData);
        }
    }
}
