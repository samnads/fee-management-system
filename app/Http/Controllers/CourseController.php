<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $data['courses'] = Course::withCount('students')->orderByDesc('id')->get();
        return view('courses', $data);
    }
    public function save_course(Request $request)
    {
        $validator = Validator::make(
            (array) $request->all(),
            [
                'name' => 'required|string',
                'duration' => 'required|integer',
                'fee_per_month' => 'required|integer',
            ],
            [],
            []
        );
        if ($validator->fails()) {
            $response = [
                'status' => false,
                'error' => [
                    'type' => 'error',
                    'title' => 'Error !',
                    'content' => $validator->errors()->first()
                ]
            ];
        } else {
            Course::create($request->all());
            $response = [
                'status' => true,
                'message' => [
                    'type' => 'success',
                    'title' => 'Saved !',
                    'content' => 'Course added successfully.'
                ],
                'redirect' => route('students')
            ];
        }
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }
}
