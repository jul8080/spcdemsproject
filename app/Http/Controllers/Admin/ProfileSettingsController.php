<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileSettingsController extends Controller
{
    // profile info settings
    public function profileSettingsPage()
    {
        $user = DB::table('users')->where('id', Auth::id())->first();
        return view('pages.admin.panel.profile_settings', compact('user'));
    }
    public function updateProfilePage(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'required',
            'position' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
        ]);
        if($validation->passes())
        {
            $user = User::findOrFail($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->middle_name = $request->middle_name;
            $user->position = $request->position;
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
    // personal info settings
    public function createOrUpdate()
    {
        $user = User::findOrFail(Auth::id());
        // dd($user);
        return view('pages.admin.panel.personal_info_settings', compact('user'));
    }

    public function  store(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $user->personalInformation()->updateOrCreate(
            [ 'user_id' =>  Auth::id()],
            [
                'user_id'     => Auth::id(),
                'address'     => $request->address,
                'phone_no'    => $request->phone_no,
                'dob'         => $request->dob,
                'birth_place' => $request->birth_place,
                'age'         => $request->age,
                'status'      => $request->status,
            ],
        );

        return response()->json([
            'success_msg' => 'Your personal information is successfully updated',
        ]);
    }

    // emergency contact info

    public function  createOrInsert()
    {
        $user = User::findOrFail(Auth::id());
        return view('pages.admin.panel.emergency_contact_settings', compact('user'));
    }

    public function  storeInfo(Request $request)
    {

        $user = User::findOrFail(Auth::id());
        $user->emergencytContactInformation()->updateOrCreate(
            [ 'user_id' =>  Auth::id()],
            [
                'user_id'     => Auth::id(),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'address' => $request->address,
                'phone_no' => $request->phone_no,
                'relationship' => $request->relationship,
            ],
        );
        return response()->json([
            'message' => 'Your emergency contact information is successfully updated',
        ]);

    }
    // password settings
    public function passwordSettingsPage()
    {
        return view('pages.admin.panel.password_settings');
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
