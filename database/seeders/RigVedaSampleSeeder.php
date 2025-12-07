<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Verse;
use Illuminate\Support\Facades\File;

class RigVedaSampleSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = database_path('data/rig_veda_mandala_1_sukta_1.json');
        $verses = json_decode(File::get($jsonPath), true);

        foreach ($verses as $verseData) {
            Verse::create($verseData);
        }
    }
}
