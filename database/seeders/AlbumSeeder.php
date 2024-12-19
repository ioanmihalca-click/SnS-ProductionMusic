<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Track;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    public function run()
    {
        // Primul album
        $album1 = Album::create([
            'name' => 'Epic Orchestra',
            'description' => 'Epic orchestral tracks for cinematic projects',
            'total_duration' => 725,
            'artwork_path' => 'albums/epic-orchestra.jpg',
            'is_featured' => true,
            'status' => 'active'
        ]);

        // Track-uri pentru primul album
        $tracks1 = [
            [
                'name' => 'Epic Dawn',
                'duration' => 180,
                'original_file_path' => 'tracks/epic-dawn.mp3',
                'is_featured' => true,
                'status' => 'active'
            ],
            [
                'name' => 'Battle Heroes',
                'duration' => 240,
                'original_file_path' => 'tracks/battle-heroes.mp3',
                'is_featured' => true,
                'status' => 'active'
            ]
        ];

        foreach ($tracks1 as $track) {
            $track = Track::create($track);
            $album1->tracks()->attach($track, ['position' => $track->id]);
        }

        // Al doilea album
        $album2 = Album::create([
            'name' => 'Ambient Waves',
            'description' => 'Relaxing ambient music',
            'total_duration' => 845,
            'artwork_path' => 'albums/ambient-waves.jpg',
            'is_featured' => true,
            'status' => 'active'
        ]);

        // Track-uri pentru al doilea album
        $tracks2 = [
            [
                'name' => 'Ocean Dreams',
                'duration' => 300,
                'original_file_path' => 'tracks/ocean-dreams.mp3',
                'is_featured' => true,
                'status' => 'active'
            ],
            [
                'name' => 'Night Sky',
                'duration' => 260,
                'original_file_path' => 'tracks/night-sky.mp3',
                'is_featured' => true,
                'status' => 'active'
            ]
        ];

        foreach ($tracks2 as $track) {
            $track = Track::create($track);
            $album2->tracks()->attach($track, ['position' => $track->id]);
        }
    }
}