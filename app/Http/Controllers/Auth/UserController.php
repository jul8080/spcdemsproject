<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // public function create() {
    //     return view('pages.admin.registerform');
    // }

    public function storeEmployee(Request $request)
    {
        $todayDate = Carbon::today();
        $qrcode = Helper::QRCodeGenerator(new User, 'qrcode', 6, 'SPCD');
        // $validation = Validator::make($request->all(),[
        //     'school_id'   => 'required',
        //     'new_user'    => 'required',
        //     'first_name'  => 'required',
        //     'last_name'   => 'required',
        //     'middle_name' => 'required',
        //     'department'  => 'required',
        //     'position'    => 'required',
        //     'email'       => 'required',
        //     'gender'      => 'required',
        //     'password'    => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
        //     'password_confirmation' => 'required|min:5'
        // ]);
        $validation = $request->validate([
            'school_id'   => 'required',
            'new_user'    => 'required',
            'first_name'  => 'required|min:2',
            'last_name'   => 'required|min:2',
            'middle_name' => 'required|min:2',
            'department'  => 'required',
            'position'    => 'required',
            'email'       => 'required|email|unique:users',
            'gender'      => 'required',
            'password'    => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:5'
        ]);

        User::create([
            'new_user'    => $request->new_user,
            'school_id'   => $request->school_id,
            'qrcode'      => $qrcode,
            'first_name'  => $request->first_name,
            'last_name'   => $request->last_name,
            'middle_name' => $request->middle_name,
            'department'  => $request->department,
            'position'    => $request->position,
            'gender'      => $request->gender,
            'email'       => $request->email,
            'password'    => Hash::make($request->password)
        ]);
        return response()->json(['status' => 200, 'message' => 'Employee account successfully registered.']);
        // if($validation->passes())
        // {
        //     User::create([
        //         'new_user'    => $request->new_user,
        //         'school_id'   => $request->school_id,
        //         'qrcode'      => $qrcode,
        //         'first_name'  => $request->first_name,
        //         'last_name'   => $request->last_name,
        //         'middle_name' => $request->middle_name,
        //         'department'  => $request->department,
        //         'position'    => $request->position,
        //         'gender'      => $request->gender,
        //         'email'       => $request->email,
        //         'password'    => Hash::make($request->password)
        //     ]);
        //     return response()->json([
        //         'status' => 200,
        //         'success' => 'Employee account successfully registered.'
        //     ]);
        // } else {

        //     return response()->json(['status' =>400,'fail' => $validation->errors()->all()]);
        // }

        //  return response()->json(['status' =>0,'fail' => $validation->errors()->all()]);
    }

    public function userLogin()
    {
        return view('auth.login');
    }

    public function checkAttemp(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if ($request->has('rememberme')) {
                Cookie::queue('emailCookie', $request->email, 1440);
                Cookie::queue('pwdCookie', $request->password, 1440);
            } else {
                Cookie::queue('emailCookie', $request->email, -1440);
                Cookie::queue('pwdCookie', $request->password, -1440);
            }
        }

        return redirect()->route('login')->with('message', 'Invalid credentials, please try again!');
    }

    public function userLogout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
