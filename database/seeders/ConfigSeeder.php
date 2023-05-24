<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::statement('DELETE FROM configs');
        } catch (\Exception $e) {
            Log::error('error while truncate config database ' . $e);
        }

        $fileName = 'cms_logo.png';
        $path = '/uploads/images/config';
        $directory = storage_path('app/public') . $path;
        if (!is_dir($directory)) {
            \File::makeDirectory($directory, $mode = 0755, true);
        }
        \Image::make(public_path('/images/logo.png'))->save($directory . '/' . $fileName, 100);
        Config::create([
            'label' => 'logo',
            'type' => 'file',
            'value' => $path . '/' . $fileName,
        ]);
        Config::create([
            'label' => 'logo1',
            'type' => 'file',
            'value' => $path . '/' . $fileName,
        ]);
        Config::create([
            'label' => 'logo2',
            'type' => 'file',
            'value' => $path . '/' . $fileName,
        ]);

        Config::create([
            'label' => 'site_header',
            'type' => 'text',
            'value' => 'Bikash',
        ]);

        Config::create([
            'label' => 'title',
            'type' => 'text',
            'value' => 'Bikash',
        ]);

        Config::create([
            'label' => 'enable_khalti',
            'type' => 'boolean',
            'value' => true,
        ]);

        Config::create([
            'label' => 'storing_logs',
            'type' => 'boolean',
            'value' => true,
        ]);
    }
}
