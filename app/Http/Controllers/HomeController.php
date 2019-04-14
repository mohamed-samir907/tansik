<?php

namespace App\Http\Controllers;

use App\Model\Type;
use App\Model\Student;
use App\Model\Ragaba;
use App\Model\SecondarySchool as School;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student    = Student::where('s_number', auth()->user()->email)->first();
        $types      = Type::all();
        $ragabas    = $student->ragabas;

        return view('home', compact('student', 'types'));
    }

    public function add_ragaba(Request $request)
    {
        $this->validate($request, [
            'school' => 'bail|array'
        ]);

        $ragabat = implode(',', $request->school);
        $student = Student::where('s_number', auth()->user()->email)->first();
        Ragaba::create([
            'student_id' => $student->id,
            'school' => $ragabat
        ]);

        session()->flash('success', 'تم اضافة الرغبات بنجاح');
        return redirect()->route('home');

    }

    public function get_student_data(Request $request)
    {
        $student = Student::where('s_number', $request->s_number)->first();

        return response([
            'status'    => true,
            'student'   => $student,
            'school'    => $student->school,
            'section'   => $student->school->section,
            'edara'     => $student->school->section->edara,
            'modria'    => $student->school->section->edara->gov,
        ]);
    }

    /**
     * Get the Secoondary Schools with section id and type id
     * 
     * @return \Illuminate\Http\Resposne
     */
    public function get_schools(Request $request)
    {
        $student    = Student::where('s_number', auth()->user()->email)->first();

        if ($student->gender == 'male') {
            $gender = 'female';
        } else {
            $gender = 'male';
        }

        $schools    = School::where('section_id', $student->school->section->id)
                            ->where('type_id', $request->type)
                            ->where('gender', '<>', $gender)
                            ->where('degree', '<=', $student->total)
                            ->get();

        return response([
            'status' => true,
            'schools' => $schools
        ]);
    }
}
