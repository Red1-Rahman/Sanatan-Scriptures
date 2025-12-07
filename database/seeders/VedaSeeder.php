<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Veda;

class VedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vedas = [
            [
                'veda_number' => 1,
                'name_sanskrit' => 'ऋग्वेद',
                'name_english' => 'Rig Veda',
                'name_transliteration' => 'Ṛgveda',
                'total_mandalas' => 10,
                'total_verses' => 10552,
                'description' => 'The Rig Veda is the oldest of the four Vedas, consisting of 1,028 hymns (suktas) organized into 10 books (mandalas). It contains hymns of praise to various deities and philosophical insights.',
            ],
            [
                'veda_number' => 2,
                'name_sanskrit' => 'सामवेद',
                'name_english' => 'Sama Veda',
                'name_transliteration' => 'Sāmaveda',
                'total_mandalas' => 2,
                'total_verses' => 1875,
                'description' => 'The Sama Veda is the Veda of melodies and chants. Most of its verses are derived from the Rig Veda, set to music for ritual purposes.',
            ],
            [
                'veda_number' => 3,
                'name_sanskrit' => 'यजुर्वेद',
                'name_english' => 'Yajur Veda',
                'name_transliteration' => 'Yajurveda',
                'total_mandalas' => 40,
                'total_verses' => 1975,
                'description' => 'The Yajur Veda is the Veda of sacrificial formulas. It contains prose mantras and instructions for performing various rituals and ceremonies.',
            ],
            [
                'veda_number' => 4,
                'name_sanskrit' => 'अथर्ववेद',
                'name_english' => 'Atharva Veda',
                'name_transliteration' => 'Atharvaveda',
                'total_mandalas' => 20,
                'total_verses' => 5987,
                'description' => 'The Atharva Veda contains hymns, spells, and incantations dealing with everyday life, health, and protection. It represents a more practical aspect of Vedic knowledge.',
            ],
        ];

        foreach ($vedas as $veda) {
            Veda::create($veda);
        }
    }
}
