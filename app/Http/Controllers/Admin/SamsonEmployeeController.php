<?php

namespace App\Http\Controllers\Admin;

use App\Models\Log;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SamsonEmployeeController extends Controller
{
    public function resetPassword()
    {
        return view('pages.admin.reset_password');
    }
    public function confirmEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where(['role_as' => 'user', 'email' => $request->input('email')])->first();
        if($user) {
            $user->update([
                'password' => ''
            ]);
            return response()->json([
                'user' => $user,
                'success' => 'Password successfully reset.'
            ]);
        }
        return response()->json(['message' => 'Email not found, please enter a valid email.']);
    }
    public function newPassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // dd($user);
        return view('pages.admin.new_password', compact('user'));
    }
    public function submitNewPassword(Request $request) {

        $request->validate([
            'password'    => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:5'
        ]);

        $user = User::findOrFail($request->id);

        $user->update([
            'password' => Hash::make($request->password)
        ]);
         return response()->json([
             'message' => 'Password change successfull.'
         ]);
    }
    public function editPosition(Request $request) 
    {
        $user = User::findOrFail($request->id);
        return response()->json([
            'user' => $user,
        ]);
    }
    public function storePosition(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->update([
            'position' => $request->position
        ]);
        return response()->json([
            'success' => 'Successfully updated.'
        ]);
    }
    public function userLists(Request $request)
    {
        $dateNow = Carbon::now();
        $today = Carbon::today();
        $authenticated = User::findOrFail(Auth::id());
        $users = User::where('role_as', 'user')->get();
        $maleCount = User::where(['role_as' => 'user','gender' => 'male'])->count();
        $femaleCount = User::where(['role_as' => 'user','gender' => 'female'])->count();
        $countNewUsers = User::whereDate('created_at', $dateNow)->where('role_as', 'user')->count();
        $newUsers = User::where('role_as', 'user')->whereDate('created_at', $dateNow)->latest()->paginate(3);

        return response()->json([
            'status' => 200,
            'users' => $users,
            'maleCount' => $maleCount,
            'femaleCount' => $femaleCount,
            'countNewUsers' => $countNewUsers,
            'newUsers' => $newUsers,
            'auth' => $authenticated
        ]);
    }
    public function exportLogs(Request $request)
    {
    
        $query = Log::query();
        if ($request->has('startDate')) {
            $query->whereDate('created_at', '>=', $request->input('startDate'));
        }
        if ($request->has('endDate')) {
            $query->whereDate('created_at', '<=', $request->input('endDate'));
        }
        $logs = $query->get();
        return response()->json([
            'status' => 200,
            'logs' => $logs
        ], 200);
    }
    public function users(Request $request)
    {
        $query = User::query();
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhere('middle_name', 'like', "%$search%");
            });
        }
        $users = $query->where('role_as', 'user')->latest()->paginate(5);
        return response()->json([
            'status' => 200,
            'users' => $users
        ], 200);
    }
    public function viewLog($id)
    {
        $log = Log::find($id);
        return response()->json([
            'status' => 200,
            'log' => $log
        ], 200);
    }
    public function employeelogs(Request $request)
    {
        $request->validate([
            'startDate' => 'date',
            'endDate' => 'date|after:startDate',
        ]);
        $query = Log::query();
        if ($request->has('startDate')) {
            $query->whereDate('created_at', '>=', $request->input('startDate'));
        }
        if ($request->has('endDate')) {
            $query->whereDate('created_at', '<=', $request->input('endDate'));
        }
        $logs = $query->paginate(5);

        return response()->json([
            'logs' => $logs
        ], 200);
    }
    public function homePage(Request $request)
    {
        if (Auth::check()) {
            return view('pages.admin.dashboard');
        }
        return redirect()->route('login');
    }

    public function employeePage()
    {

        $users = User::whereNotNull('last_seen')
            ->orderBy('last_seen', 'DESC')->get();
        $todayDate = Carbon::today();

        $search = request()->query('search');
        if ($search) {
            $users = User::where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('middle_name', 'like', '%' . $search . '%')
                ->where('role_as', 'user')->latest()->paginate(5);
        } else {
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

        if (!empty($request->date)) {
            $attendances = Attendance::where('created_at', 'LIKE', '%' . $request->date . '%')->latest()->paginate(5);
        }
        if (!empty($request->time_status)) {
            $attendances = Attendance::where('time_status', 'LIKE', '%' . $request->time_status . '%')
                ->latest()->paginate(5);
        }
        if (!empty($request->date) && !empty($request->time_status)) {
            $attendances = Attendance::where('created_at', 'LIKE', '%' . $request->date . '%')
                ->latest()->where('time_status', 'LIKE', '%' . $request->time_status . '%')
                ->paginate(5);
        }
        if ($request->time_status == 'all status') {
            $attendances = Attendance::latest()->latest()->paginate(5);
        }
        if ($request->date && $request->time_status == 'all status') {
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
        $validation = Validator::make($request->all(), [
            'employee_status' => 'required',
            'department' => 'required',
            'position' => 'required',
        ]);
        if ($validation->passes()) {
            $user = User::findOrFail($request->id);
            $user->employee_status = $request->employee_status;
            $user->department = $request->department;
            $user->position = $request->position;
            $user->update();
            return redirect()->back();
        } else {
            return response()->json(['status' => 0, 'fail' => $validation->errors()->all()]);
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


        $user = User::where('first_name', 'LIKE', '%' . $name . '%')
            ->orWhere('last_name', 'LIKE', '%' . $name . '%')
            ->orWhere('middle_name', 'LIKE', '%' . $name . '%')
            ->where('role_as', 'user')->get();

        return json_encode($user);
    }
}
