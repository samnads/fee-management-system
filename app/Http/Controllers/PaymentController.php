<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $data['payments'] = Payment::with('course','student')->get();
        $data['students'] = Student::orderByDesc('students.id')->get();
        return view('payments', $data);
    }
    public function save_payment(Request $request)
    {
        $payment = new Payment();
        $payment->student_id = $request->student_id;
        $payment->course_id = $request->course_id;
        $payment->amount_paid = $request->amount;
        $payment->date_of_payment = $request->date_of_payment;
        $payment->save();
        $response = [
            'status' => true,
            'message' => [
                'type' => 'success',
                'title' => 'Payment Added!',
                'content' => 'Payment added successfully !'
            ]
        ];
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }
}
