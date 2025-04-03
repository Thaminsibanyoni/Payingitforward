<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryLanguageSeeder extends Seeder
{
    protected $countries = [
        // Africa
        ['code' => 'ZA', 'name' => 'South Africa', 'currencies' => ['ZAR'], 'languages' => ['en','zu','af'], 'timezone' => 'Africa/Johannesburg'],
        ['code' => 'NG', 'name' => 'Nigeria', 'currencies' => ['NGN'], 'languages' => ['en'], 'timezone' => 'Africa/Lagos'],
        ['code' => 'KE', 'name' => 'Kenya', 'currencies' => ['KES'], 'languages' => ['en','sw'], 'timezone' => 'Africa/Nairobi'],
        
        // Europe
        ['code' => 'GB', 'name' => 'United Kingdom', 'currencies' => ['GBP'], 'languages' => ['en'], 'timezone' => 'Europe/London'],
        ['code' => 'DE', 'name' => 'Germany', 'currencies' => ['EUR'], 'languages' => ['de'], 'timezone' => 'Europe/Berlin'],
        
        // Americas
        ['code' => 'US', 'name' => 'United States', 'currencies' => ['USD'], 'languages' => ['en'], 'timezone' => 'America/New_York'],
        ['code' => 'BR', 'name' => 'Brazil', 'currencies' => ['BRL'], 'languages' => ['pt'], 'timezone' => 'America/Sao_Paulo'],
        
        // Asia
        ['code' => 'CN', 'name' => 'China', 'currencies' => ['CNY'], 'languages' => ['zh'], 'timezone' => 'Asia/Shanghai'],
        ['code' => 'AE', 'name' => 'UAE', 'currencies' => ['AED'], 'languages' => ['ar'], 'timezone' => 'Asia/Dubai'],
        
        // Oceania
        ['code' => 'AU', 'name' => 'Australia', 'currencies' => ['AUD'], 'languages' => ['en'], 'timezone' => 'Australia/Sydney']
    ];

    protected $languages = [
        ['code' => 'en', 'name' => 'English'],
        ['code' => 'fr', 'name' => 'French'],
        ['code' => 'es', 'name' => 'Spanish'],
        ['code' => 'pt', 'name' => 'Portuguese'],
        ['code' => 'zh', 'name' => 'Chinese'],
        ['code' => 'ar', 'name' => 'Arabic'],
        ['code' => 'sw', 'name' => 'Swahili'],
        ['code' => 'zu', 'name' => 'Zulu'],
        ['code' => 'af', 'name' => 'Afrikaans'],
        ['code' => 'de', 'name' => 'German'],
        ['code' => 'ru', 'name' => 'Russian'],
        ['code' => 'ja', 'name' => 'Japanese']
    ];

    public function run()
    {
        // Seed countries
        foreach ($this->countries as $country) {
            DB::table('countries')->insert([
                'code' => $country['code'],
                'name' => $country['name'],
                'currencies' => json_encode($country['currencies']),
                'languages' => json_encode($country['languages']),
                'timezone' => $country['timezone']
            ]);
        }

        // Seed languages
        foreach ($this->languages as $language) {
            DB::table('languages')->insert([
                'code' => $language['code'],
                'name' => $language['name']
            ]);
        }
    }
}
