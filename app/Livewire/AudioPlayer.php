<?php

namespace App\Livewire;

use App\Models\Track;
use Livewire\Component;

class AudioPlayer extends Component
{
    public $tracks;

    public function mount()
    {
        // Preluăm doar track-urile featured și active
        $this->tracks = Track::where('is_featured', true)
            ->where('status', 'active')
            ->select([
                'id',
                'name',
                'duration',
                'preview_file_path as file', // folosim preview-ul pentru demo
                'artwork_path as artwork'
            ])
            ->get()
            ->map(function ($track) {
                return [
                    'id' => $track->id,
                    'name' => $track->name,
                    'duration' => gmdate('i:s', $track->duration), // convertim durata în format mm:ss
                    'file' => asset('storage/' . $track->file),
                    'artwork' => $track->artwork ? asset('storage/' . $track->artwork) : null,
                    'artist' => 'Snow N Stuff' // hardcodat pentru moment
                ];
            })
            ->toArray();
    }

    public function render()
    {
        return view('livewire.audio-player');
    }
}