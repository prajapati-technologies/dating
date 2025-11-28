<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        Setting::create([
            'app_name' => 'My Dating App',
            'home_description' => 'Find your perfect match ❤️',
            'contact_email' => 'support@example.com',
        ]);
    }
}
