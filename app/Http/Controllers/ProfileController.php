<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //
    public function index()
    {
        return view('Tampilan.profile');
    }

    public function changeFotoProfile(Request $request)
    {
        # 
        try {
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20348',
                ]);

                $oldImg = $request->image->getClientOriginalName();

                $request->image->storeAs('profile_img', $oldImg);

                $user = User::all()->where('id', Auth::user()->id)->first();

                Storage::disk('public')->delete("/profile_img/. $user->image");

                $user->image = $oldImg;
                $user->updated_at = date(now());
                $user->save();

                return redirect()->route('profile');
        
        } catch (\Throwable $th) {
                 return redirect()->back()->with('toast_warning', 'Error ' . $th->getMessage());
        }
    }

    public function changeDataProfile(Request $request)
    {
        try {
          
            // mengambil data user berdasarkan id 
            $user = User::all()->where('id', auth()->user()->id)->first();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->updated_at = date(now());
            $user->save();

            return redirect()->route('profile');

       } catch(\Throwable $th) {
        return redirect()->back()->with('toast_warning', 'Error ' . $th->getMessage());
       }
    }
}
