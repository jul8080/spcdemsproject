<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PersonalInformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\EmergencyContactInformation;

class AdminProfileController extends Controller
{
    public function adminProfile()
    {
        $user = User::findOrFail(Auth::id());
        $personalInfo = PersonalInformation::where('user_id', Auth::id())->first();
        $contactInfo = EmergencyContactInformation::where('user_id', Auth::id())->first();
        return view('pages.admin.profile', compact('user', 'personalInfo', 'contactInfo'));
    }


    public function updatePhoto(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'select_file' => '
                required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $old_image = User::findOrFail(Auth::id());
        if($validation->passes())
        {
            if($old_image->image != '')
            {
                $image = $request->file('select_file');
                $user_image = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $user_image);
                unlink('images/'.$old_image->image);
            }else{
                $image = $request->file('select_file');
                $user_image = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $user_image);
            }

            // saving the data to the database
            DB::table('users')->where('id', Auth::user()->id)->update([
                'image' => $user_image
            ]);
            return response()->json([
                'message' => 'Image Upladed Successfully',
                'uploaded_image' => '<img class="object-cover w-full h-full" src="/images/'.$user_image.'"/>'
            ]);
        } else {
            return response()->json([
                'message'        => $validation->errors()->all(),
                'uploaded_image' => '',
            ]);
        }
    }
}
