<?php

namespace App\Livewire;

use Livewire\Component;

class AudioPlayer extends Component
{
    public $tracks = [
        [
            'id' => 1,
            'name' => 'Dry Martini',
            'duration' => '2:45',
            'file' => null
        ],
        [
            'id' => 2,
            'name' => 'Cinematic Impact',
            'duration' => '3:15',
            'file' => null
        ],
        [
            'id' => 3,
            'name' => 'Riviera',
            'duration' => '4:00',
            'file' => null
        ]
    ];

    public $currentTrack = 0;
    public $isPlaying = false;

    public function mount()
    {
        // Actualizăm căile fișierelor cu URL-uri complete
        $this->tracks = array_map(function($track) {
            $filename = strtolower(str_replace(' ', '-', $track['name'])) . '.mp3';
            $track['file'] = asset('storage/' . $filename);
            return $track;
        }, $this->tracks);
    }

    public function playTrack($index)
    {
        if ($this->currentTrack === $index && $this->isPlaying) {
            $this->isPlaying = false;
            $this->dispatch('pauseAudio');
        } else {
            $this->currentTrack = $index;
            $this->isPlaying = true;
            $this->dispatch('playAudio', [
                'track' => $this->tracks[$index]
            ]);
        }
    }

    public function render()
    {
        return view('livewire.audio-player');
    }
}