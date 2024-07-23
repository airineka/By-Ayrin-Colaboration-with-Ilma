<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PesananIndex extends Component
{
    public $pesanans;
    public function render()
    {
        return view('livewire.pesanan-index', [
            'pesanans' => $this->pesanans,
        ]);
    }

    public function mount()
    {
        // Ambil pesanan milik akun yang sedang login
        $this->pesanans = Auth::user()->pesanans; 
    }
}
