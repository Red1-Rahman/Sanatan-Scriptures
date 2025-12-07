<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purana;
use Illuminate\Support\Facades\File;

class PuranaSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = database_path('data/puranas.json');
        $puranas = json_decode(File::get($jsonPath), true);

        foreach ($puranas as $puranaData) {
            Purana::create($puranaData);
        }
    }
}
