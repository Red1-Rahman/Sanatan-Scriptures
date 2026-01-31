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
            Veda::create([
                'veda_number' => $vedaData['veda_number'],
                'name_sanskrit' => $vedaData['name_sanskrit'],
                'name_english' => $vedaData['name_english'],
                'name_transliteration' => $vedaData['name_transliteration'],
                'total_mandalas' => $vedaData['total_mandalas'] ?? $vedaData['total_books'] ?? 0,
                'total_verses' => $vedaData['total_verses'] ?? $vedaData['total_verses_estimated'] ?? 0,
                'description' => $vedaData['notes'] ?? null,
            ]);
        }
        
        $this->command->info('Vedas imported successfully!');
    }
}
