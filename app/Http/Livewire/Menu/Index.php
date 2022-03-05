<?php

namespace App\Http\Livewire\Menu;

use App\Models\Menu;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    public $nama_menu, $harga, $desc, $stok, $photo;
    
    use WithFileUploads;

    
    // Edit 
    public $showEditModal = false;
    public $selected_id; 

    // Search
    public $search;
    protected $updatesQueryString = [ 'search' ];


    // Delete
    protected $listeners = ['delete']; // delete listener emit alert 

    public function render()
    {
        $menu = Menu::latest()->paginate(8);

        if($this->search !== null) {
            $menu = Menu::where('nama_menu', 'like', '%' . $this->search . '%')->latest()->paginate();
        }
        
        return view('livewire.menu.index', [
            'menu' => $menu            

            ])->with('i', (request()->input('page', 1)- 1) * 3);  
            dd($this->search);
    }
    

    public function confirmdelete($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'icon' => 'warning',
            'title' => 'Are you sure?',
            'text' => '',
            'id' => $id
        ]);
    }

    public function delete($id)
    {
        Menu::where('id', $id)->delete();

        $this->dispatchBrowserEvent('alert', ['message' => 'Berhasil Dihapus !!!']);

    }
}

