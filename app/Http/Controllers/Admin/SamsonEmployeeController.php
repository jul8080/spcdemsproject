<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\PersonalInformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\EmergencyContactInformation;
use App\Helpers\Helper;
use App\Models\Log;

class SamsonEmployeeController extends Controller
{
    public function users() {
        $users = User::latest()->get();
        return response()->json([
            'status' => 200,
            'users' => $users
        ], 200);
    }
    public function viewLog($id) {
        $log = Log::find($id);
        return response()->json([
            'status' => 200,
            'log' => $log
        ], 200);
    }
    public function employeelogs() {
        $logs = Log::latest()->paginate(10);
        if ($logs->count() > 0) {
            return response()->json([
                'status' => 200,
                'attendace' => $logs
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No logs found!'
            ], 404);
        }
    }
    public function homePage(Request $request)
    {

        $dateNow = Carbon::now();
        $today = Carbon::today();
        if(Auth::check())
        {
            $users = User::where('role_as', 'user')->get();
            $male = User::where('gender', 'male')->count();
            $female = User::where('gender', 'female')->count();
            $newUserCount = User::whereDate('created_at', $dateNow)->count();
            $usersTable = User::where('role_as', 'user')->orderBy('created_at', 'desc')->latest()->paginate(5);

            return view('pages.admin.dashboard', compact('users', 'usersTable', 'dateNow', 'newUserCount','male', 'female', 'dateNow', 'today'));
        }
        return redirect()->route('login');
    }

    public function employeePage()
    {
       
        $users = User::
                whereNotNull('last_seen')
                ->orderBy('last_seen', 'DESC')->get();
        $todayDate = Carbon::today();

        $search = request()->query('search');
        if($search)
        {
            $users = User::where('first_name', 'like', '%'.$search.'%')
                    ->orWhere('last_name', 'like', '%'.$search.'%')
                    ->orWhere('middle_name', 'like', '%'.$search.'%')
                    ->where('role_as', 'user')->latest()->paginate(5);
        }else {
            $users = User::where('role_as', 'user')->latest()->paginate(5);
        }

        return view('pages.admin.employee', compact('users', 'todayDate'));
    }

    public function Profile($id)
    {
        $user = user::findOrFail($id);

        return view('pages.admin.user_profile', compact('user'));
    }

    public function attendancePage(Request $request)
    {
        $attendances = Attendance::latest()->paginate(5);

        $todayDate = Carbon::today();

        if(!empty($request->date))
        {
            $attendances = Attendance::where('created_at', 'LIKE', '%' . $request->date . '%')->latest()->paginate(5);
        }
        if(!empty($request->time_status))
        {
            $attendances = Attendance::
                                    where('time_status', 'LIKE', '%' . $request->time_status . '%')
                                    ->latest()->paginate(5);
        }
        if(!empty($request->date) && !empty($request->time_status))
        {
            $attendances = Attendance::where('created_at', 'LIKE', '%' . $request->date . '%')
                                        ->latest()->where('time_status', 'LIKE', '%' . $request->time_status . '%')
                                        ->paginate(5);
        }
        if($request->time_status == 'all status')
        {
            $attendances = Attendance::latest()->latest()->paginate(5);
        }
        if($request->date && $request->time_status == 'all status')
        {
            $attendances = Attendance::where('created_at', 'LIKE', '%' . $request->date . '%')->latest()->paginate(5);
        }

        return view('pages.admin.attendance', compact('todayDate', 'attendances'));
    }
    public function userPage()
    {
        $users = User::latest()->paginate(5);
        return view('pages.admin.user', compact('users'));
    }
    public function userEdit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }
    public function userStore(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'employee_status' => 'required',
            'department' => 'required',
            'position' => 'required',
        ]);
        if($validation->passes())
        {
            $user = User::findOrFail($request->id);
            $user->employee_status = $request->employee_status;
            $user->department = $request->department;
            $user->position = $request->position;
            $user->update();
            return redirect()->back();
        } else {
            return response()->json(['status' =>0,'fail' => $validation->errors()->all()]);
        }

    }
    // user page end
    public function settingsPage()
    {
        return view('pages.admin.settings');
    }
    public function editPage()
    {
        return view('pages.admin.edit');
    }

    public function searchUser(Request $request)
    {
        $name = $request->get('searchEmployee');


        $user = User::where('first_name', 'LIKE', '%' . $name .'%')
                    ->orWhere('last_name', 'LIKE', '%' . $name .'%')
                    ->orWhere('middle_name', 'LIKE', '%' . $name .'%')
                    ->where('role_as', 'user')->get();

        return json_encode($user);
    }
}
