<?php

namespace App\Livewire;

use Livewire\Component;

class PersistentPlayer extends Component
{
    public $tracks = [];
    public $currentTrack = null;

    protected $listeners = ['initPersistentPlayer'];

    public function initPersistentPlayer($trackData)
    {
        $this->tracks[] = $trackData;
        $this->currentTrack = count($this->tracks) - 1;
    }

    public function render()
    {
        return view('livewire.persistent-player');
    }
}