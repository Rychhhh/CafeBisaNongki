<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use App\Models\User;
use Livewire\Component;
use App\Models\Transaksi;

class Dashboard extends Component
{
    public function render()
    {   
        
        return view('livewire.dashboard', [
            'users' => User::all(),
            'menu' => Menu::all()->count(),
            'transaksi' => Transaksi::all()->count()
        ]);
        
        $this->dispatchBrowserEvent('alert', ['message' => 'Hello']);
    }
}
