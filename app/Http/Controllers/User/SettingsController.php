<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{

    public function profileSettingsPage()
    {
        $user = DB::table('users')->where('id', Auth::id())->first();
        return view('pages.user.panel.profile_settings', compact('user'));
    }

    public function updateProfilePage(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
        ]);
        if($validation->passes())
        {
            $user = User::findOrFail($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->middle_name = $request->middle_name;
            $user->gender = $request->gender;
            $user->email = $request->email;
            $user->update();
            return response()->json([
                'status' => 1,
                'success' => 'Your personal information is successfully updated',
            ]);
        } else {
            return response()->json(['status' =>0,'fail' => $validation->errors()->all()]);
        }
    }

    public function passwordSettingsPage()
    {
        return view('pages.user.panel.password_settings');
    }

    public function passwordChangePage(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required',
        ]);
        $currentPassword = Hash::check($request->current_password, Auth::user()->password);
        if($currentPassword)
        {
            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect()->back()->with('success', 'Password successfully change.');
        }
        return redirect()->back()->with('fail', 'Current password does not match with the old password.');
    }

}
