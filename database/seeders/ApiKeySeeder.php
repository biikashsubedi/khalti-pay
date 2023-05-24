<?php

namespace Database\Seeders;

use App\Models\ApiKey;
use Illuminate\Database\Seeder;

class ApiKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (ApiKey::$apiType as $type) {
            $apiKey = ApiKey::whereType($type)->first();
            if (!isset($apiKey)) {
                ApiKey::create([
                    'key' => \Str::random(20),
                    'detail' => "{}",
                    'hits' => 0,
                    'type' => $type,
                    'status' => true
                ]);
            }
        }
    }
}
