<?php

namespace Database\Seeders;

use App\Models\WhyGefen;
use App\Models\WhyGefenTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WhyGefenSeeder extends Seeder
{
    public function run()
    {
        $why = new WhyGefen();
        $why->photo_1 = 'photo1';
        $why->photo_2 = 'photo2';
        $why->photo_3 = 'photo3';
        $why->save();
        foreach (active_langs() as $lang) {
            $translation = new WhyGefenTranslation();
            $translation->locale = $lang->code;
            $translation->description = 'description'.$lang->code;
            $translation->why_gefen_id = $why->id;
            $translation->save();
        }
    }
}
