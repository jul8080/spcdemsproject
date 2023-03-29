<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmergencyContactInformation extends Controller
{
    public function  createOrUpdate()
    {
        $user = User::findOrFail(Auth::id());
        return view('pages.user.panel.emergency_contact_settings', compact('user'));
    }

    public function  store(Request $request)
    {

        $user = User::findOrFail(Auth::id());
        $user->emergencytContactInformation()->updateOrCreate(
            [ 'user_id' =>  Auth::id()],
            [
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
}
