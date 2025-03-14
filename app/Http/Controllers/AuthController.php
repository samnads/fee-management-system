<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\StudentCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    public function login_or_home(Request $request)
    {
        if (Auth::check()) {
            $data['payments'] = Payment::selectRaw("SUM(amount_paid) as amount_paid")->first();
            $data['student_courses'] = StudentCourse::selectRaw("SUM(total_fee) as total_fee")->first();
            $data['enrolled'] = StudentCourse::selectRaw("COUNT(DISTINCT(student_id)) as count")->first();
            return view('dashboard', $data);
        } else {
            return view('login', []);
        }
    }
    public function login_view(Request $request)
    {
        return view('login', []);
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
