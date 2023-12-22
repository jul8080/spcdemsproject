<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Log;


class EmployeeAttendance extends Controller
{
    public function logs(Request $request)
    {   
        $request->validate([
            'startDate' => 'date',
            'endDate' => 'date|after:startDate',
        ]);
        $user = auth()->user();
        $query = Log::where('user_id', $user->id);

     
         if ($request->has('startDate')) {
             $query->whereDate('created_at', '>=', $request->input('startDate'));
         }

         if ($request->has('endDate')) {
            $query->whereDate('created_at', '<=', $request->input('endDate'));
        }


        $logs = $query->paginate(5);
        return response()->json([
            'logs' => $logs
        ]);
    }
    public function attendancePage(Request $request)
    {
        $attendances = Attendance::where('user_id', Auth::id())->latest()->paginate(5);

        if(!empty($request->date))
        {
            $attendances = Attendance::where('user_id', Auth::id())
                        ->where('created_at', 'LIKE', '%' . $request->date . '%')
                        ->latest()->paginate(5);
        }
        if(!empty($request->time_status))
        {
            $attendances = Attendance::where('user_id', Auth::id())
                                    ->where('time_status', 'LIKE', '%' . $request->time_status . '%')
                                    ->latest()->paginate(5);
        }
        if(!empty($request->date) && !empty($request->time_status))
        {
            $attendances = Attendance::where('user_id', Auth::id())
                                        ->where('created_at', 'LIKE', '%' . $request->date . '%')
                                        ->where('time_status', 'LIKE', '%' . $request->time_status . '%')
                                        ->latest()->paginate(5);
        }
        if($request->time_status == 'all status')
        {
            $attendances = Attendance::where('user_id', Auth::id())->latest()->paginate(5);
        }
        if($request->date && $request->time_status == 'all status')
        {
            $attendances = Attendance::where('user_id', Auth::id())
                            ->where('created_at', 'LIKE', '%' . $request->date . '%')
                            ->latest()->paginate(5);
        }
        return view('pages.user.attendance', compact('attendances'));
    }
    public function storeTime(Request $request)
    {
        $todayDate = Carbon::today();
        $validation = Validator::make($request->all(),[
            // 'first_name'     => 'required',
            // 'last_name'      => 'required',
            // 'middle_name'    => 'required',
            'day'            => 'required',
            'time'           => 'required',
            'time_status'    => 'required',
        ]);

        if($validation->passes())
        {
            $user = User::findOrFail(Auth::id());
            $user->attendances()->create([
                'new_time' => $todayDate,
                'first_name' => Auth::user()->first_name,
                'last_name' => Auth::user()->last_name,
                'middle_name' => Auth::user()->middle_name,
                'day' => $request->day,
                'time' => $request->time,
                'time_status' => $request->time_status,
           ]);
            return response()->json([
                'status' => 1,
                'message' => 'Save successfully',
            ]);
        } else {
            return response()->json(['status' =>0,'message' => $validation->errors()->all()]);
        }

    }

}
