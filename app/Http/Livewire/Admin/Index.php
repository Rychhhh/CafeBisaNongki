<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;

class Index extends Component
{
    public $name, $email, $role;
    public $selected_id;

    public $search;

    protected $updateQueryString = [ 'search' ];

    protected $listeners = ['delete'];

    public function render()
    {
        $users = User::latest()->orderBy('id' , 'DESC')->paginate(8);

        if($this->search !== null) {
            $users = User::where('name', 'like', '%'. $this->search . '%' )->latest()->paginate();
        }

        return view('livewire.admin.index' , 
        [
            'users' => $users
        ]
    );
    }

    public function edit($id)
    {
        $edit = User::findOrFail($id);
        $this->selected_id = $id;

        $this->name = $edit->name;
        $this->email = $edit->email;
        $this->role = $edit->role;


        $this->dispatchBrowserEvent('show-modal');

    }


    public function updateUser()
    {
       $this->validate([
           'selected_id' => 'required|numeric',
           'name' => 'required|string',
           'email' => 'required',
           'role' => 'required'
       ],
       [
           'required' => 'Field Harus Ada !!!',
           'email.unique' => 'Email Harus Unique'
       ]);

       if($this->selected_id) {
           $edit = User::find($this->selected_id);

           $edit->name = $this->name;
           $edit->email = $this->email;
           $edit->role = $this->role;
           $edit->save();
            
       }

       $this->dispatchBrowserEvent('hide-modal');

       $this->dispatchBrowserEvent('alert', ['message' => 'Berhasil Update !!!']);

        return redirect()->back();
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
        User::where('id', $id)->delete();

        $this->dispatchBrowserEvent('alert', [
            'toastr' => 'success',
            'message' => 'Berhasil Dihapus !!!'
    ]);
    }
}
