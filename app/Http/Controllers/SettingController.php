<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    function index()
    {
        return view('admin.settings.index');
    }
    function changePassword()
    {
        return view('admin.settings.change-password');
    }
    public function updatePassword(Request $request)
    {
        $validate = $request->validate([
            'old_password' => 'required|',
            'new_password' => 'required|min:6|max:20',
            'confirm_password' => 'required|min:6|max:20|same:new_password'
        ]);

        $old_password = $request->old_password;
        $new_password = $request->new_password;

        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);

        $auth = Hash::check($old_password, $user->password);
        if ($auth) {
            $user->password = Hash::make($new_password);
            $user->update();
            return back()->with('updated', 'Successfully changed');
        } else {
            return back()->withErrors([
                'incorrect' => 'Incorrect old password'
            ]);
        }
        return back();
    }
}