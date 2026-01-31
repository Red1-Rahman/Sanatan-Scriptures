<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Verse;
use Illuminate\Support\Facades\File;

class RigVedaSampleSeeder extends Seeder
{
    public function run(): void
    {
        // Manually insert sample Rig Veda verses from Mandala 1, Sukta 1
        // This is a temporary solution due to JSON file encoding issues
        
        $verses = [
            [
                'veda_number' => 1,
                'mandala_number' => 1,
                'sukta_number' => 1,
                'verse_number' => 1,
                'sanskrit_text' => 'अग्निमीळे पुरोहितं यज्ञस्य देवमृत्विजम् । होतारं रत्नधातमम् ॥',
                'transliteration' => 'agním īḷe purohitaṁ yajñasya devam ṛtvijam | hotāraṁ ratna-dhātamam ||',
                'translation_english' => 'I praise Agni, the household priest, the divine officiant of the sacrifice, the invoker who bestows the greatest wealth.',
                'rishi' => 'Madhuchchhandas Vaishvamitra',
                'deity' => 'Agni',
                'metre' => 'Gāyatrī',
            ],
            [
                'veda_number' => 1,
                'mandala_number' => 1,
                'sukta_number' => 1,
                'verse_number' => 2,
                'sanskrit_text' => 'अग्निः पूर्वेभिरृषिभिरीड्यो नूतनैरुत । स देवाँ एह वक्षति ॥',
                'transliteration' => 'agniḥ pūrvebhir ṛṣibhir īḍyo nūtanair uta | sa devān eha vakṣati ||',
                'translation_english' => 'Agni, worthy of praise by ancient seers and by the modern ones, shall bring the gods here.',
                'rishi' => 'Madhuchchhandas Vaishvamitra',
                'deity' => 'Agni',
                'metre' => 'Gāyatrī',
            ],
            [
                'veda_number' => 1,
                'mandala_number' => 1,
                'sukta_number' => 1,
                'verse_number' => 3,
                'sanskrit_text' => 'अग्निना रयिमश्नवत्पोषमेव दिवेदिवे । यशसं वीरवत्तमम् ॥',
                'transliteration' => 'agninā rayim aśnavat poṣam eva dive-dive | yaśasaṁ vīravattamam ||',
                'translation_english' => 'Through Agni one gains wealth and nourishment day by day, glorious and rich in heroic sons.',
                'rishi' => 'Madhuchchhandas Vaishvamitra',
                'deity' => 'Agni',
                'metre' => 'Gāyatrī',
            ],
        ];
        
        foreach ($verses as $verse) {
            Verse::create($verse);
        }
        
        $this->command->info('Rig Veda sample verses imported successfully!');
    }
}
