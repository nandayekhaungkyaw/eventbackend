<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $eventIds = Event::pluck('id', 'title');
        $files = ['default1.jpg', 'default2.jpg', 'default3.jpg'];

        foreach ($files as $file) {

            // Source file path inside seeders
            $sourcePath = database_path("seeders/files/{$file}");

            // Target path inside storage
            $targetPath = "eventImages/{$file}";

            // Copy file if not already exists
            if (!Storage::disk('public')->exists($targetPath)) {
                Storage::disk('public')->put($targetPath, file_get_contents($sourcePath));
            }

            // Insert database record
            Image::create([
                'image' => $file,
                'event_id' => $eventIds['Laravel Workshop'],  // Make sure event with id 1 exists
            ]);
        }
    }
}
