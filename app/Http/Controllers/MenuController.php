<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{

    public function index()
    {
        return view('Tampilan.menu.menu');
    }

    public function create()
    {
        return view('Tampilan.menu.create');
    }

    public function store(Request $request)
    {
        $file_name = $request->photo->getClientOriginalName();
        $request->photo->storeAs('menu', $file_name);

        $newMenu = new Menu;
        $newMenu->nama_menu = $request->nama_menu;
        $newMenu->desc = $request->desc;
        $newMenu->stok = $request->stok;
        $newMenu->harga = $request->harga;
        $newMenu->photo = $file_name;

        $newMenu->save();

        return redirect('menu')->with('success', 'Berhasil !');
    }

    public function edit($id)
    {
        $edit = Menu::find($id);
        return view('Tampilan.menu.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $edit = Menu::find($id);

        // jika user tidak upload foto
        // ambil value fotolama
        $file_name = $request->oldphoto;

        // jika photo baru
        if($request->hasFile('photo')) {
            $file_name = $request->photo->getClientOriginalName();
            $request->photo->storeAs('menu', $file_name);
        }

        $edit->nama_menu = $request->nama_menu;
        $edit->desc = $request->desc;
        $edit->stok = $request->stok;
        $edit->harga = $request->harga;
        $edit->photo = $file_name;
        $edit->save();

        return redirect('menu')->with('success', 'Berhasil !');
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $menu = Menu::where('nama_menu', 'Like', '%' . $search . '%')->latest()->paginate();

        return view('Tampilan.menu.menu', compact('menu'));

    }

}
