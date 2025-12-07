<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BhagavadGitaVerse;
use Illuminate\Support\Facades\File;

class BhagavadGitaSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = database_path('data/bhagavad_gita_sample.json');
        $verses = json_decode(File::get($jsonPath), true);

        foreach ($verses as $verseData) {
            BhagavadGitaVerse::create($verseData);
        }
    }
}
