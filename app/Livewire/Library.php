<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\Mood;
use App\Models\Genre;
use App\Models\Track;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Livewire\Attributes\Title;

#[Title('Library - Snow N Stuff Production Music')]
class Library extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedGenres = [];
    public $selectedMoods = [];
    public $selectedDurations = [];
    public $sortBy = 'newest';
    public $view = 'grid';
    public $perPage = 12;
    public $loading = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedGenres' => ['except' => []],
        'selectedMoods' => ['except' => []],
        'selectedDurations' => ['except' => []],
        'sortBy' => ['except' => 'newest'],
        'view' => ['except' => 'grid'],
        'perPage' => ['except' => 12]
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        // Inițializare pentru player
        $this->dispatch('playerInit');
    }

    public function getTracks()
    {
        $this->loading = true;

        $query = Track::query();

        // Aplicăm filtrele de căutare
        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('artist', 'like', '%' . $this->search . '%');
            });
        }

        // Filtrăm după genuri
        if (!empty($this->selectedGenres)) {
            $query->whereHas('genres', function($q) {
                $q->whereIn('name', $this->selectedGenres);
            });
        }

        // Filtrăm după mood-uri
        if (!empty($this->selectedMoods)) {
            $query->whereHas('moods', function($q) {
                $q->whereIn('name', $this->selectedMoods);
            });
        }

        // Filtrăm după durată
        if (!empty($this->selectedDurations)) {
            $query->where(function($q) {
                foreach ($this->selectedDurations as $duration) {
                    list($min, $max) = explode('-', $duration);
                    if ($max === '+') {
                        $q->orWhere('duration', '>=', $min);
                    } else {
                        $q->orWhereBetween('duration', [$min, $max]);
                    }
                }
            });
        }

        // Aplicăm sortarea
        switch ($this->sortBy) {
            case 'newest':
                $query->latest();
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'name':
                $query->orderBy('name');
                break;
            case 'duration':
                $query->orderBy('duration');
                break;
            case 'popularity':
                $query->orderBy('plays_count', 'desc');
                break;
        }

        $tracks = $query->with(['genres', 'moods'])
                       ->paginate($this->perPage);

        $this->loading = false;

        return $tracks;
    }

    public function playTrack($trackId)
{
    $track = Track::findOrFail($trackId);
    
    // Increment play count
    $track->increment('plays_count');
    
    // Dispatch event for persistent player
    $this->dispatch('initPersistentPlayer', [
        'id' => $track->id,
        'name' => $track->name,
        'duration' => gmdate('i:s', $track->duration),
        'file' => asset('storage/' . $track->preview_file_path),
        'artwork' => $track->artwork_path ? asset('storage/' . $track->artwork_path) : asset('assets/default-track-artwork.jpg'),
        'artist' => 'Snow N Stuff'
    ]);
}

    public function toggleFavorite($trackId)
    {
        if (Auth::user()) {
            $user = Auth::user();
            $user->favorites()->toggle($trackId);
            
            // Returnăm starea actualizată
            return $user->favorites()->where('track_id', $trackId)->exists();
        }
        
        return false;
    }
    

    public function clearFilters()
    {
        $this->reset(['selectedGenres', 'selectedMoods', 'selectedDurations', 'search']);
        $this->resetPage();
    }



    public function render()
    {
        return view('livewire.library', [
            'tracks' => $this->getTracks(),
            'genres' => Genre::orderBy('name')->get(),
            'moods' => Mood::orderBy('name')->get(),
            'totalTracks' => Track::count(),
        ]);
    }
}