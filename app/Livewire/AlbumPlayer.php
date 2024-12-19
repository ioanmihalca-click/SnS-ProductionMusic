<?php

namespace App\Livewire;

use App\Models\Album;
use Livewire\Component;

class AlbumPlayer extends Component
{
    public $albums;
    public $currentAlbumTracks;

    public function mount()
    {
        $this->albums = Album::where('is_featured', true)
            ->where('status', 'active')
            ->with(['tracks' => function ($query) {
                $query->select([
                    'tracks.id',
                    'tracks.name',
                    'tracks.duration',
                    'tracks.original_file_path as file',
                    'tracks.artwork_path as artwork'
                ])
                ->where('tracks.status', 'active')
                ->orderBy('album_track.position');
            }])
            ->select([
                'id',
                'name',
                'description', // adăugat description
                'artwork_path',
                'total_duration'
            ])
            ->get()
            ->map(function ($album) {
                return [
                    'id' => $album->id,
                    'name' => $album->name,
                    'description' => $album->description, // adăugat description
                    'artwork' => $album->getArtworkUrl(),
                    'duration' => $album->getDurationForHumans(),
                    'tracks' => $album->tracks->map(function ($track) {
                        return [
                            'id' => $track->id,
                            'name' => $track->name,
                            'duration' => gmdate('i:s', $track->duration),
                            'file' => asset('storage/' . $track->file),
                            'artwork' => $track->artwork ? asset('storage/' . $track->artwork) : null,
                            'artist' => 'Snow N Stuff'
                        ];
                    })->toArray()
                ];
            })
            ->toArray();
    }


    public function render()
    {
        return view('livewire.album-player');
    }
}