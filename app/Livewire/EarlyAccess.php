<?php

namespace App\Livewire;

use Livewire\Component;

class EarlyAccess extends Component
{
    public function mount()
    {
        if (!session('has_early_access')) {
            return redirect('/');
        }
    }

    public function render()
    {
        return view('livewire.early-access');
    }
}