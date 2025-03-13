<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $data['page'] = $request->page ?: 1;
        $data['students'] = Student::orderByDesc('id')->with('courses')->paginate(10);
        return view('students', $data);
    }
    public function save_student(Request $request)
    {
        $validator = Validator::make(
            (array) $request->all(),
            [
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'dob' => 'required',
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
            Student::create($request->all());
            $response = [
                'status' => true,
                'message' => [
                    'type' => 'success',
                    'title' => 'Saved !',
                    'content' => 'Student added successfully.'
                ],
                'redirect' => route('students')
            ];
        }
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }
    public function student_data(Request $request,$id)
    {
        $student = Student::findOrFail($id);
        //$student_courses = StudentCourse::where('student_id',$id)->get();
        $response['status'] = true;
        $response['student'] = $student;
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

}
