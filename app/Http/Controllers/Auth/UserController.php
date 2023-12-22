<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use App\Helpers\Helper;

class UserController extends Controller
{
    public function storeEmployee(Request $request)
    {
        $todayDate = Carbon::today();
        $qrcode = Helper::QRCodeGenerator(new User, 'qrcode', 6, 'QR');
        $validation = $request->validate([
            'first_name'  => 'required|min:2',
            'last_name'   => 'required|min:2',
            'middle_name' => 'required|min:2',
            'position'    => 'required',
            'email'       => 'required|email|unique:users',
            'gender'      => 'required',
            'password'    => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:5'
        ]);

        User::create([
            'qrcode'      => $qrcode,
            'first_name'  => $request->first_name,
            'last_name'   => $request->last_name,
            'middle_name' => $request->middle_name,
            'position'    => $request->position,
            'gender'      => $request->gender,
            'email'       => $request->email,
            'password'    => Hash::make($request->password)
        ]);
        return response()->json(['status' => 200, 'message' => 'Employee account successfully registered.']);
    }

    public function userLogin()
    {
        return view('auth.login');
    }

    public function checkAttemp(Request $request)
    {
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
