<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PersonalInformation;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\EmergencyContactInformation;

class UserRoleController extends Controller
{
    public function getImage() 
    {
        $image = User::findOrFail(Auth::id());
        return response()->json([
            'status' => 200,
            'user' => $image
        ]);
    }
    public function homePage()
    {
        $dt = Carbon::now();
        $dt->timezone('Asia/Singapore');
        $todayTime = $dt->format('H:i');
        if (Auth::check()) {
            $attendanceIn = Attendance::where('user_id', Auth::id())->where('time_status', 'Time In')->latest()->paginate(5);
            $attendanceOut = Attendance::where('user_id', Auth::id())->where('time_status', 'Time Out')->latest()->paginate(5);
            return view('pages.user.dashboard', compact('todayTime', 'attendanceIn', 'attendanceOut'));
        }
        return redirect()->route('login')->with('message', 'Invalid credentials, please try again!');
    }
    public function userInfo(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $personalInfo = PersonalInformation::where('user_id', Auth::id())->first();
        $contactInfo = EmergencyContactInformation::where('user_id', Auth::id())->first();
        return response()->json([
            'status' => 200,
            'user' => $user,
            'personalinfo' => $personalInfo,
            'contactinfo' => $contactInfo
        ]);
    }
    public function userProfile()
    {
        // $user = User::findOrFail(Auth::id());
        // $personalInfo = PersonalInformation::where('user_id', Auth::id())->first();
        // $contactInfo = EmergencyContactInformation::where('user_id', Auth::id())->first();
        // return view('pages.user.profile', compact('user', 'personalInfo', 'contactInfo'));
        return view('pages.user.profile');
    }


    public function changePhoto(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'select_file' => '
                required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $old_image = User::findOrFail(Auth::id());
        if ($validation->passes()) {
            if ($old_image->image != '') {
                $image = $request->file('select_file');
                $user_image = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $user_image);
                unlink('images/' . $old_image->image);
            } else {
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
                'uploaded_image' => '<img class="object-cover w-full h-full rounded-md" src="/images/' . $user_image . '"/>'
            ]);
        } else {
            return response()->json([
                'message'        => $validation->errors()->all(),
                'uploaded_image' => '',
            ]);
        }
    }
    public function uploadImage(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'image' => '
                required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $old_image = User::findOrFail(Auth::id());
        if ($validation->passes()) {
            if ($old_image->image != '') {
                $image = $request->file('image');
                $user_image = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $user_image);
                unlink('images/' . $old_image->image);
            } else {
                $image = $request->file('image');
                $user_image = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $user_image);
            }
            DB::table('users')->where('id', Auth::user()->id)->update([
                'image' => $user_image
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Image Upladed Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => $validation->errors()->all(),
            ]);
        }
    }
    
}
