<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Verse;

class RigVedaSampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Seeds Mandala 1, Sukta 1 (Agni Sukta) - 9 verses
     */
    public function run(): void
    {
        $verses = [
            [
                'veda_number' => 1,
                'mandala_number' => 1,
                'sukta_number' => 1,
                'verse_number' => 1,
                'sanskrit_text' => 'अग्निमीळे पुरोहितं यज्ञस्य देवमृत्विजम् । होतारं रत्नधातमम् ॥',
                'transliteration' => 'agnim īḷe purohitaṃ yajñasya devam ṛtvijam | hotāraṃ ratnadhātamam ||',
                'translation_english' => 'I praise Agni, the chosen Priest, God, minister of sacrifice, The hotar, lavisher of wealth.',
                'translation_hindi' => 'मैं अग्नि की स्तुति करता हूँ, जो पुरोहित हैं, यज्ञ के देव हैं, ऋत्विज हैं, होता हैं और रत्नों के दाता हैं।',
                'commentary' => 'This is the opening verse of the Rig Veda, addressing Agni, the fire deity who serves as the divine priest.',
                'deity' => 'Agni',
                'rishi' => 'Madhucchandā Vaiśvāmitra',
                'metre' => 'Gāyatrī',
            ],
            [
                'veda_number' => 1,
                'mandala_number' => 1,
                'sukta_number' => 1,
                'verse_number' => 2,
                'sanskrit_text' => 'अग्निः पूर्वेभिरृषिभिरीड्यो नूतनैरुत । स देवाँ एह वक्षति ॥',
                'transliteration' => 'agniḥ pūrvebhir ṛṣibhir īḍyo nūtanair uta | sa devām̐ eha vakṣati ||',
                'translation_english' => 'Agni, worthy of praise by former and present seers, May he bring the Gods here.',
                'translation_hindi' => 'अग्नि पूर्व और वर्तमान ऋषियों द्वारा स्तुत्य हैं, वे देवताओं को यहाँ लाएं।',
                'commentary' => 'This verse emphasizes Agni\'s eternal nature and his role as the intermediary between humans and gods.',
                'deity' => 'Agni',
                'rishi' => 'Madhucchandā Vaiśvāmitra',
                'metre' => 'Gāyatrī',
            ],
            [
                'veda_number' => 1,
                'mandala_number' => 1,
                'sukta_number' => 1,
                'verse_number' => 3,
                'sanskrit_text' => 'अग्निना रयिमश्नवत्पोषमेव दिवेदिवे । यशसं वीरवत्तमम् ॥',
                'transliteration' => 'agninā rayim aśnavat poṣam eva dive-dive | yaśasaṃ vīravattamam ||',
                'translation_english' => 'Through Agni, one obtains wealth day by day, prosperity and fame attended by heroic sons.',
                'translation_hindi' => 'अग्नि के द्वारा प्रतिदिन धन, पोषण, यश और वीर पुत्रों से युक्त समृद्धि प्राप्त होती है।',
                'commentary' => 'The verse describes the material and spiritual benefits of worshipping Agni.',
                'deity' => 'Agni',
                'rishi' => 'Madhucchandā Vaiśvāmitra',
                'metre' => 'Gāyatrī',
            ],
            [
                'veda_number' => 1,
                'mandala_number' => 1,
                'sukta_number' => 1,
                'verse_number' => 4,
                'sanskrit_text' => 'अग्ने यं यज्ञमध्वरं विश्वतः परिभूरसि । स इद्देवेषु गच्छति ॥',
                'transliteration' => 'agne yaṃ yajñam adhvaraṃ viśvataḥ paribhūr asi | sa id deveṣu gacchati ||',
                'translation_english' => 'O Agni, the sacrifice and ritual which you encompass on every side, that indeed goes to the Gods.',
                'translation_hindi' => 'हे अग्नि, जिस यज्ञ और अध्वर को तुम सब ओर से घेरते हो, वही देवताओं तक पहुँचता है।',
                'commentary' => 'This verse highlights Agni\'s role in conveying sacrifices to the celestial realm.',
                'deity' => 'Agni',
                'rishi' => 'Madhucchandā Vaiśvāmitra',
                'metre' => 'Gāyatrī',
            ],
            [
                'veda_number' => 1,
                'mandala_number' => 1,
                'sukta_number' => 1,
                'verse_number' => 5,
                'sanskrit_text' => 'अग्निर्होता कविक्रतुः सत्यश्चित्रश्रवस्तमः । देवो देवेभिरागमत् ॥',
                'transliteration' => 'agnir hotā kavikratuḥ satyaś citraśravastamah | devo devebhir āgamat ||',
                'translation_english' => 'Agni, the Hotar-priest with the heart of a sage, the truthful, most renowned, the God shall come with the Gods.',
                'translation_hindi' => 'अग्नि होता हैं, कवि के समान बुद्धिमान हैं, सत्य हैं, अत्यंत विख्यात हैं, वे देव देवताओं के साथ आएं।',
                'commentary' => 'The verse praises Agni\'s wisdom and divine nature.',
                'deity' => 'Agni',
                'rishi' => 'Madhucchandā Vaiśvāmitra',
                'metre' => 'Gāyatrī',
            ],
            [
                'veda_number' => 1,
                'mandala_number' => 1,
                'sukta_number' => 1,
                'verse_number' => 6,
                'sanskrit_text' => 'यदङ्ग दाशुषे त्वमग्ने भद्रं करिष्यसि । तवेत्तत्सत्यमङ्गिरः ॥',
                'transliteration' => 'yad aṅga dāśuṣe tvam agne bhadraṃ kariṣyasi | tavet tat satyam aṅgiraḥ ||',
                'translation_english' => 'Whatever blessing, O Agni, you will grant to the worshipper, that, O Angiras, is indeed your truth.',
                'translation_hindi' => 'हे अग्नि, दाता के लिए तुम जो भी कल्याण करोगे, हे अंगिरस, वह तुम्हारा सत्य है।',
                'commentary' => 'This verse expresses faith in Agni\'s benevolence and truthfulness.',
                'deity' => 'Agni',
                'rishi' => 'Madhucchandā Vaiśvāmitra',
                'metre' => 'Gāyatrī',
            ],
            [
                'veda_number' => 1,
                'mandala_number' => 1,
                'sukta_number' => 1,
                'verse_number' => 7,
                'sanskrit_text' => 'उप त्वाग्ने दिवेदिवे दोषावस्तर्धिया वयम् । नमो भरन्त एमसि ॥',
                'transliteration' => 'upa tvāgne dive-dive doṣāvastar dhiyā vayam | namo bharanta emasi ||',
                'translation_english' => 'To you, O Agni, day by day, at dawn and dusk, we approach with thought bringing homage.',
                'translation_hindi' => 'हे अग्नि, हम प्रतिदिन प्रातः और सायं विचारपूर्वक नमस्कार लाते हुए तुम्हारे पास आते हैं।',
                'commentary' => 'The verse describes the regular worship of Agni at dawn and dusk.',
                'deity' => 'Agni',
                'rishi' => 'Madhucchandā Vaiśvāmitra',
                'metre' => 'Gāyatrī',
            ],
            [
                'veda_number' => 1,
                'mandala_number' => 1,
                'sukta_number' => 1,
                'verse_number' => 8,
                'sanskrit_text' => 'राजन्तमध्वराणां गोपामृतस्य दीदिवम् । वर्धमानं स्वे दमे ॥',
                'transliteration' => 'rājantam adhvarāṇāṃ gopām ṛtasya dīdivam | vardhamānaṃ sve dame ||',
                'translation_english' => 'The radiant guardian of rituals, the protector of the cosmic order, growing in his own house.',
                'translation_hindi' => 'यज्ञों के राजा, सत्य के रक्षक, दीप्तिमान, अपने घर में वृद्धि पाने वाले।',
                'commentary' => 'This verse describes Agni\'s sovereignty over rituals and his protective nature.',
                'deity' => 'Agni',
                'rishi' => 'Madhucchandā Vaiśvāmitra',
                'metre' => 'Gāyatrī',
            ],
            [
                'veda_number' => 1,
                'mandala_number' => 1,
                'sukta_number' => 1,
                'verse_number' => 9,
                'sanskrit_text' => 'स नः पितेव सूनवेऽग्ने सूपायनो भव । सचस्वा नः स्वस्तये ॥',
                'transliteration' => 'sa naḥ piteva sūnave\'gne sūpāyano bhava | sacasvā naḥ svastaye ||',
                'translation_english' => 'Be to us like a father to his son, O Agni, be easily accessible to us. Be with us for our well-being.',
                'translation_hindi' => 'हे अग्नि, पुत्र के प्रति पिता के समान हमारे लिए सुलभ हों। हमारे कल्याण के लिए हमारे साथ रहें।',
                'commentary' => 'The concluding verse of the first hymn, expressing a personal relationship with Agni and seeking his protection.',
                'deity' => 'Agni',
                'rishi' => 'Madhucchandā Vaiśvāmitra',
                'metre' => 'Gāyatrī',
            ],
        ];

        foreach ($verses as $verse) {
            Verse::create($verse);
        }
    }
}
