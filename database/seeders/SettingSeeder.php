<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            ['name' => 'facebook', 'link' => 'https://facebook.com/'],
            ['name' => 'phone', 'link' => '+994550000000'],
            ['name' => 'instagram', 'link' => 'https://instagram.com/'],
            ['name' => 'email', 'link' => 'harmony@gefen.az'],
            ['name' => 'mail_receiver', 'link' => 'harmony@gefen.az'],
            ['name' => 'address', 'link' => 'Tbilisi Prospekti 34, Çıraq Plaza'],
            ['name' => 'whatsapp', 'link' => '+994555552055'],
        ];
        foreach ($settings as $key => $setting) {
            $set = new Setting();
            $set->name = $setting['name'];
            $set->link = $setting['link'];
            $set->status = 1;
            $set->save();
        }
    }
}
