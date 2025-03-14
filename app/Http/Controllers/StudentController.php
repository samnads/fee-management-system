<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\StudentCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $data['page'] = $request->page ?: 1;
        $data['students'] = Student::orderByDesc('students.id')->with('courses')->withSum('payments', 'amount_paid')->withTrashed()->paginate(10);
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
    public function student_data(Request $request, $id)
    {
        $response['status'] = true;
        $student = Student::find($id);
        if (!$student) {
            $response = [
                'status' => false,
                'error' => [
                    'type' => 'error',
                    'title' => 'Not Active !',
                    'content' => 'Selected user not active !'
                ],
            ];
        } else {
            //$student_courses = StudentCourse::where('student_id',$id)->get();
            $response['student'] = $student;
            $response['all_courses'] = Course::get();
            $response['student_courses'] = StudentCourse::
            leftJoin('courses','student_courses.course_id','=','courses.id')
            ->where([['student_id', '=', $id]])->get();
        }
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }
    public function toggle(Request $request)
    {
        if ($request->enable === '0') {
            Student::withTrashed()->where('id', $request->id)->delete();
        } else {
            Student::withTrashed()->where('id', $request->id)->restore();
        }
        $response = [
            'status' => true,
            'message' => [
                'type' => 'success',
                'title' => $request->enable === '0' ? 'Disabled !' : 'Enabled !',
                'content' => 'Student ' . ($request->enable === 0 ? 'disabled' : 'enabled') . ' successfully.'
            ]
        ];
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }
    public function assign_course(Request $request)
    {
        foreach ($request->courses as $course_id) {
            $course = Course::findOrFail($course_id);
            $student_course = StudentCourse::where([['student_id', '=', $request->student_id], ['course_id', '=', $course_id]])->withTrashed()->first();
            if (!$student_course) {
                $student_course = new StudentCourse();
                $student_course->student_id = $request->student_id;
                $student_course->course_id = $course_id;
                $student_course->duration = $course->duration;
                $student_course->fee_per_month = $course->fee_per_month;
                $student_course->total_fee = $course->duration * $course->fee_per_month;
                $student_course->save();
            }
            $student_course_ids[] = $student_course->id;
        }
        StudentCourse::where('student_id', $request->student_id)->whereNotIn('id', $student_course_ids)->delete();
        $response = [
            'status' => true,
            'message' => [
                'type' => 'success',
                'title' => 'Assigned !',
                'content' => 'Course assigned successfully.'
            ]
        ];
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

}
