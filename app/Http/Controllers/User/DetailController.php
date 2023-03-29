<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DetailController extends Controller
{
    public function createOrUpdate()
    {
        $user = User::findOrFail(Auth::id());
        // dd($user);
        return view('pages.user.panel.personal_info_settings', compact('user'));
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


        // return redirect()->back()->with('success', 'Your personal information successfully updated.');
    }
}
