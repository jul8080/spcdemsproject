<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ScannerController extends Controller
{
    
    public function logs()
    {
        $dt = Carbon::now();
        $dateNow = date('Y-m-d');
        $users = Log::where('date', $dateNow)->latest()->paginate(10);

        return response()->json([
            'status' => 200,
            'users' => $users
        ], 200);
    }
    public function index()
    {
        $data = Log::all();
        $dt = Carbon::now();
        $dt->timezone('Asia/Singapore');
        $todayTime = $dt->format('H:i');
        return view('pages.scanner.index', compact('todayTime', 'data'));
    }
    public function create()
    {
        $todayDate = Carbon::today();
        return view('pages.admin.registerform');
    }
    public function store(Request $request)
    {

        $dt = Carbon::now();
        $dateNow = date('Y-m-d');
        $user = User::where('qrcode', $request->qrcode)->first();
        if ($user) {
            $logs = Log::where(['user_id' => $user->id, 'date' => $request->date, 'status' => '0'])->get();
            if ($logs->count() > 0) {
                Log::where(['date' => $dateNow, 'user_id' => $user->id,])->whereNull('time_out')->update([
                    'time_out' => $request->time,
                    'status' => '1'
                ]);
                return response()->json([
                    'status' => 1,
                    'success_time_out' => 'You successfully Time Out.',
                ]);
            } else {
                Log::create([
                    'user_id' => $user->id,
                    'last_name' => $user->last_name,
                    'first_name' => $user->first_name,
                    'middle_name' => $user->middle_name,
                    'time_in' => $request->time,
                    'day' => $request->day,
                    'date' => $request->date,
                    'status' => '0'
                ]);

                return response()->json([
                    'status' => 1,
                    'success_time_in' => 'You successfully Time In.',
                ]);
            }
        } else {
            return response()->json([
                'status' => 0,
                'fail' => 'Sorry no data found, please contact your administrator',
            ]);
        }
    }
}
