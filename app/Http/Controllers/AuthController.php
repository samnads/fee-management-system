<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    public function login_or_home(Request $request)
    {
        if (Auth::check()) {
            return view('dashboard', []);
        } else {
            return view('login', []);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login_or_home');

    }
    public function login(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            $validator = Validator::make(
                (array) $input,
                [
                    'email' => 'required|string',
                    'password' => 'required|string',
                ],
                [],
                [
                    'email' => 'Username',
                    'password' => 'Password',
                ]
            );
            if ($validator->fails()) {
                $response = [
                    'status' => false,
                    'error' => [
                        'type' => 'error',
                        'title' => 'Login Failed !',
                        'content' => $validator->errors()->first()
                    ]
                ];
            } else {
                $credentials = $request->validate([
                    'email' => ['required'],
                    'password' => ['required'],
                ]);
                $remember_me = $request->has('remember_me') ? true : false;
                if (Auth::attempt($credentials, $remember_me)) {
                    $request->session()->regenerate();
                    $response = [
                        'status' => true,
                        'message' => [
                            'type' => 'success',
                            'title' => 'Success !',
                            'content' => 'Logged in successfully.'
                        ],
                        'redirect' => url('')
                    ];
                } else {
                    $response = [
                        'status' => false,
                        'error' => [
                            'type' => 'error',
                            'title' => 'Login Failed !',
                            'content' => 'Invalid login credentials.'
                        ]
                    ];
                }
            }
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        }
    }
}
