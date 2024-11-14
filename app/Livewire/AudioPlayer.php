<?php

namespace App\Livewire;

use Livewire\Component;

class AudioPlayer extends Component
{
    public $tracks = [
    
        [
            'id' => 1,
            'name' => 'Riviera',
            'artist' => 'Snow N Stuff',
            'duration' => '2:45',
            'file' => 'https://production-music-sns.test/storage/music/riviera.mp3',
            'artwork' => 'storage/artowork/thumbnail-riviera.jpg'
        ],

        [
            'id' => 1,
            'name' => 'Riviera',
            'artist' => 'Snow N Stuff',
            'duration' => '2:45',
            'file' => 'https://production-music-sns.test/storage/music/riviera.mp3',
            'artwork' => 'storage/artowork/thumbnail-riviera.jpg'
        ],

        [
            'id' => 1,
            'name' => 'Riviera',
            'artist' => 'Snow N Stuff',
            'duration' => '2:45',
            'file' => 'https://production-music-sns.test/storage/music/riviera.mp3',
            'artwork' => 'storage/artowork/thumbnail-riviera.jpg'
        ]
        // Aici poți adăuga mai multe track-uri sau le poți încărca din baza de date
    ];

    public function mount()
    {
        // Aici poți face orice inițializare necesară
        // De exemplu, încărcarea track-urilor din baza de date
        // $this->tracks = Track::all()->toArray();
    }

    public function render()
    {
        return view('livewire.audio-player');
    }
}