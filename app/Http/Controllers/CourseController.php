<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $data['courses'] = Course::withCount('students')->orderByDesc('id')->withTrashed()->get();
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
    public function toggle(Request $request)
    {
        if ($request->enable === '0') {
            Course::withTrashed()->where('id', $request->id)->delete();
        } else {
            Course::withTrashed()->where('id', $request->id)->restore();
        }
        $response = [
            'status' => true,
            'message' => [
                'type' => 'success',
                'title' => $request->enable === '0' ? 'Disabled !' : 'Enabled !',
                'content' => 'Course ' . ($request->enable === 0 ? 'disabled' : 'enabled') . ' successfully.'
            ]
        ];
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }
    public function course_data(Request $request, $id)
    {
        $response['status'] = true;
        $course = Course::find($id);
        if (!$course) {
            $response = [
                'status' => false,
                'error' => [
                    'type' => 'error',
                    'title' => 'Not Active !',
                    'content' => 'Selected course not active !'
                ],
            ];
        } else {
            //$student_courses = StudentCourse::where('student_id',$id)->get();
            $response['course'] = $course;
        }
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }
    public function update_course(Request $request)
    {
        $course = Course::find($request->id);
        $course->name = $request->name;
        $course->duration = $request->duration;
        $course->fee_per_month = $request->fee_per_month;
        $course->save();
        $response = [
            'status' => true,
            'message' => [
                'type' => 'success',
                'title' => 'Updated !',
                'content' => 'Course details updated !!'
            ],
        ];
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }
}
