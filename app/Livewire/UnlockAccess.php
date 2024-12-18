<?php

namespace App\Livewire;

use Livewire\Component;

class UnlockAccess extends Component
{
    public $accessKey = '';
    public $error = '';
    
    protected $validKeys = [
        'VIP-ACCESS-25'
    ];

    public function verifyKey()
    {
        $key = strtoupper($this->accessKey);
        
        if (in_array($key, $this->validKeys)) {
            session(['has_early_access' => true]);
            $this->redirect(route('early-access', ['token' => config('early-access.token')]));
        }

        $this->error = 'Invalid access key. Please try again.';
    }

    public function render()
    {
        return view('livewire.unlock-access');
    }
}