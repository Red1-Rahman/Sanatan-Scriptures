<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MahabharataParva;
use Illuminate\Support\Facades\File;

class MahabharataParvaSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = database_path('data/mahabharata_parvas.json');
        $parvas = json_decode(File::get($jsonPath), true);

        foreach ($parvas as $parvaData) {
            MahabharataParva::create($parvaData);
        }
    }
}
