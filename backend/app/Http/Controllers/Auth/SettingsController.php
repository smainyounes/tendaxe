<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function EditPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
            'old_password' => 'required',
        ]);

        // check if old password match
        if(Hash::check($request->old_password, Auth::user()->password)){
            // checked
            $obj_user = User::find(Auth::id());
            $obj_user->password = Hash::make($request->password);
            $obj_user->save(); 
            
            return back()->with('success' , 'mot de passe a été changer avec Succès');

        }else{
            return back()->with('error' , 'mauvais mot de passe');
        }
    }

    public function editemail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
        ]);

        $user = Auth::user();


        $user->email = $request->email;

        $user->save();

        return back()->with('success', 'email a été changé avec succés');
    }

    public function editphone(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|numeric|unique:users',
        ]);

        $user = Auth::user();


        $user->phone = $request->phone;

        $user->save();

        return back()->with('success', 'telephone a été changé avec succés');
    }
}
