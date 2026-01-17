<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PuranaVerse;
use Illuminate\Support\Facades\File;

class BrahmaPuranaSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = database_path('data/brahma_purana_content.json');
        
        if (!File::exists($jsonPath)) {
            $this->command->error("File not found: $jsonPath");
            return;
        }
        
        $jsonContent = File::get($jsonPath);
        $verses = json_decode($jsonContent, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->command->error('JSON decode error: ' . json_last_error_msg());
            return;
        }
        
        if (!is_array($verses)) {
            $this->command->error('Invalid JSON structure');
            return;
        }

        $this->command->info('Starting to seed ' . count($verses) . ' verses...');
        
        // Clear existing verses for this purana
        PuranaVerse::where('purana_number', 1)->delete();
        
        foreach ($verses as $index => $verseData) {
            try {
                // Decode HTML entities in Sanskrit text
                if (isset($verseData['sanskrit_text'])) {
                    $verseData['sanskrit_text'] = html_entity_decode($verseData['sanskrit_text'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
                }
                
                PuranaVerse::create($verseData);
                
                if (($index + 1) % 100 == 0) {
                    $this->command->info('Processed ' . ($index + 1) . ' verses...');
                }
            } catch (\Exception $e) {
                $this->command->warn('Error at verse ' . ($index + 1) . ': ' . $e->getMessage());
            }
        }

        $this->command->info('Brahma Purana verses seeded successfully!');
    }
}
