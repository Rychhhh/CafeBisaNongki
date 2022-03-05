<?php

namespace App\Http\Livewire\Transaksi;

use App\Models\Menu;
use App\Models\User;
use Livewire\Component;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class Index extends Component
{
    public $nama_pelanggan, $nama_menu, $jumlah, $total_harga, $nama_pegawai;

    public $selected_id; // edit form

    public $showEditModal = false; // membedakan edit dan add modal

    protected $listeners = ['delete']; // delete listener emit alert 

    public function render()
    {
        return view('livewire.transaksi.index', [
            'transaksi' => Transaksi::latest()->paginate(3),
            'users' => User::all()
        ]);
    }


    public function add() {
        $this->showEditModal = false;

        $this->nama_pelanggan = [];
        $this->nama_menu = [];
        $this->jumlah = [];
        $this->total_harga = [];
        $this->nama_pegawai = [];

        $this->dispatchBrowserEvent('show-modal');

    }

    public function createTransaksi() {
        
        $this->validate([
            'nama_pelanggan' => 'required',
            'nama_menu' => 'required',
            'jumlah' => 'required',
            'total_harga' => 'required',
            'nama_pegawai' => 'required'
        ],
            [
                'nama_pelanggan.required' => 'Nama Pelanggan Tidak Boleh Kosong !!!',
                'nama_menu.required' => 'Nama Menu Tidak Boleh Kosong !!!',
                'jumlah.required' => 'Jumlah Tidak Boleh Kosong !!!',
                'total_harga.required' => 'Konfirmasi Harga Anda !!!',
                'nama_pegawai.required' => 'Nama Pegawai Tidak Boleh Kosong !!!',
            ]
        );

        // transaksi +1 maka stok -1
        $menu = Menu::whereNamaMenu($this->nama_menu)->firstOrFail();

        if($menu->stok <= $this->jumlah) {
            $this->dispatchBrowserEvent('swal:modal', [
                'title' => 'error',
                'icon' => "error",
                'text' => "Jumlah Permintaan Lebih dari Stok",
            ]);

            return back();
        }

        Transaksi::create([
                'nama_pelanggan' => $this->nama_pelanggan,
                'nama_menu' => $this->nama_menu,
                'jumlah' => $this->jumlah,
                'total_harga' => $this->total_harga,
                'nama_pegawai' => $this->nama_pegawai
        ]);
    

        $menu->update([
            'stok' => $menu->stok - $this->jumlah
        ]);


       

        $this->dispatchBrowserEvent('hide-modal');

        $this->dispatchBrowserEvent('swal:modal', [
            'title' => 'Success',
            'icon' => "success",
            'text' => "Data Berhasil Disimpan",
        ]);

        return redirect()->back();
    }

    // pilih harga berdasarkan nama menu
    public function pilihMenu()
    {
        $menu = Menu::whereNamaMenu($this->nama_menu)->firstOrFail();

        // listener di transaksi.blade
        $this->dispatchBrowserEvent('harga_menu', $menu->harga);

    }


    public function edit($id) {
        $this->showEditModal = true;
        
        $record = Transaksi::findOrFail($id);
        $this->selected_id = $id;

        $this->nama_pelanggan = $record->nama_pelanggan;
        $this->nama_menu = $record->nama_menu;
        $this->jumlah = $record->jumlah;
        $this->total_harga = $record->total_harga;
        $this->nama_pegawai = $record->nama_pegawai;

        $this->dispatchBrowserEvent('show-modal');
    }

    // proses edit
    public function updateTransaksi()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'nama_pelanggan' => 'required',
            'nama_menu' => 'required',
            'jumlah' => 'required',
            'total_harga' => 'required',
            'nama_pegawai' => 'required'
        ]);

        if($this->selected_id) {
            $record = Transaksi::find($this->selected_id);
            $record->update([
                'nama_pelanggan' => $this->nama_pelanggan,
                'nama_menu' => $this->nama_menu,
                'jumlah' => $this->jumlah,
                'total_harga' => $this->total_harga,
                'nama_pegawai' => $this->nama_pegawai
            ]);
        }

        $this->dispatchBrowserEvent('hide-modal');

        $this->dispatchBrowserEvent('swal:modal', [
            'title' => 'Info',
            'icon' => "info",
            'text' => "Data Berhasil Diupdate",
        ]);

        return redirect()->back();

    }
    
    public function deleteConfirm($id) {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'icon' => 'warning',
            'title' => 'Are you sure?',
            'text' => '',
            'id' => $id
        ]);
    }

    public function delete($id) {
       Transaksi::where('id', $id)->delete();

       $this->dispatchBrowserEvent('swal:modal', [
           'icon' => 'info',
           'type' => 'info', 
           'title' => 'Data Berhasil Dihapus'
       ]);
   }

}
