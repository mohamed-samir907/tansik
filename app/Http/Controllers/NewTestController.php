<?php

namespace App\Http\Controllers;

use App\MyHelper;
use App\Model\Type;
use App\Model\Student;
use App\Model\Ragaba;
use App\Model\SecondarySchool as School;
use Illuminate\Http\Request;

class NewTestController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student    = Student::where('s_number', auth()->user()->email)->first();
        $types      = Type::all();
        $ragabas = [];

        if ($student->ragabas != null) {
          $schools = explode(',', $student->ragabas->school);

          for ($i = 0; $i < count($schools); $i++)
          {
              array_push($ragabas, School::where('id', $schools[$i])->first());
          }
        }

        if ($student->gender == 'male') {
            $gender = 'female';
        } else {
            $gender = 'male';
        }
        
        $industrial = School::where('section_id', $student->school->section->id)
                          ->where('type', 'industrial')
                          ->where('gender', '<>', $gender)
                          ->where('degree', '<=', $student->total)
                          ->get();

        $agricultural = School::where('section_id', $student->school->section->id)
                          ->where('type', 'agricultural')
                          ->where('gender', '<>', $gender)
                          ->where('degree', '<=', $student->total)
                          ->get();

        $trading = School::where('section_id', $student->school->section->id)
                          ->where('type', 'trading')
                          ->where('gender', '<>', $gender)
                          ->where('degree', '<=', $student->total)
                          ->get();

        $other = School::where('section_id', $student->school->section->id)
                          ->where('type', 'other')
                          ->where('gender', '<>', $gender)
                          ->where('degree', '<=', $student->total)
                          ->get();
        
        $ragabas = collect($ragabas);

        return view('test', compact('student', 'types', 'ragabas', 'industrial', 'agricultural', 'trading', 'other'));
    }


    /**
     * Add Ragaba for the student
     *
     * @param  \Illuminate\Http\Request $request
     * @return \inate\Http\Response
     */
    public function add_ragaba(Request $request)
    {
        $this->validate($request, [
            'school' => 'bail|array'
        ]);

        if ($request->school == null) {
            return back()->withErrors(['من فضلك قم باختيار ثلاث رغبات']);
        }

        if (count($request->school) < 3)
            return back()->withErrors(['من فضلك قم باختيار ثلاث رغبات']);
        
        foreach ($request->school as $key => $value) {
            if ($value == null)
                return back()->withErrors(['من فضلك قم باختيار ثلاث رغبات']);
        }
        
        $ragabat = implode(',', $request->school);
        

        $student = Student::where('s_number', auth()->user()->email)->first();
        
        $ragaba = Ragaba::create([
            'student_id' => $student->id,
            'school' => $ragabat
        ]);

        $schools = [];
        foreach ($request->school as $sch) {
          array_push($schools, School::find($sch));
        }
        
        if ($request->ajax()) {
          return response([
            'status'  => true,
            'schools'   => $schools
          ]);
        }

        session()->flash('success', 'تم اضافة الرغبات بنجاح');
        return redirect()->route('home');

    }

    /**
     * Get the student data
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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
     * add the selected high ragaba to the student
     * 
     * @return \Illuminate\Http\Response
     */
    public function addHigh(Request $request)
    {
      $student    = Student::where('s_number', auth()->user()->email)->first();

      if ($student->gender == 'male') {
          $gender = 'female';
      } else {
          $gender = 'male';
      }

      $schools    = School::where('section_id', $student->school->section->id)
                        ->where('type', 'high')
                        ->where('gender', '<>', $gender)
                        ->where('degree', '<=', $student->total)
                        ->first();

      if ($ragaba = Ragaba::where('student_id', $student->id)->first()) {
        $ragaba->school = $schools->id;
        $ragaba->save();
      } else {
        Ragaba::create([
            'student_id' => $student->id,
            'school' => $schools->id
        ]);
      }
                        
      return response([
        'status'  => true,
        'type'    => 'high',
        'schools'   => $schools
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
                            ->where('type', $request->type)
                            ->where('gender', '<>', $gender)
                            ->where('degree', '<=', $student->total)
                            ->get();

        return response([
            'status' 	=> true,
            'type' 		=> $request->type,
            'schools' 	=> $schools
        ]);
    }

    /**
     * Validate the student edited data and store it in the database
     * 
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function editStuedntData(Request $request)
    {
        $this->validate($request, [
            'address' => 'required|string|max:50',
            'national_id' => 'required|digits:14',
            'phone' => 'required|digits:11',
            'student_id' => 'required|exists:users,email'
        ]);
        
        list($phone)            = MyHelper::sanitizeInteger($request->phone);
        list($address)          = MyHelper::sanitizeString($request->address);
        list($national_id)      = MyHelper::sanitizeInteger($request->national_id);
        $student_number         = $request->student_id;

        $student = Student::where('s_number', $student_number)->first();

        $student->phone = $phone;
        $student->address = $address;
        $student->national_id = $national_id;
        $student->save();

        $ragabas = 0;

        if ($student->ragabas != null) {
          $ragabas = 1;
        }

        return response()->json([
            'success'       => 'success',
            'phone'         => $student->phone,
            'address'       => $student->address,
            'national_id'   => $student->national_id,
            'ragabas'       => $ragabas
        ]);
    }
    
    /**
     * Edit the student ragabas
     * 
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit_ragaba(Request $request)
    {
        $this->validate($request, [
            'school' => 'bail|array'
        ]);
        
        $student = Student::where('s_number', auth()->user()->email)->first();
        $ragaba = Ragaba::where('student_id', $student->id)->first();
        
        if ($request->school == null) {
            $ragaba->delete();
            session()->flash('success', 'تم حذف الرغبات بنجاح، برجاء قم بتسجيل رغبات جديدة');
            return redirect()->route('home');
        }

        if (!$request->type) {
            if (count($request->school) < 3)
                return back()->withErrors(['من فضلك قم باختيار ثلاث رغبات']);
            
            foreach ($request->school as $key => $value) {
                if ($value == null)
                    return back()->withErrors(['من فضلك قم باختيار ثلاث رغبات']);
            }
        }
        
        $ragabat = implode(',', $request->school);

        $ragaba->school = $ragabat;
        $ragaba->save();

        session()->flash('success', 'تم تعديل الرغبات بنجاح');
        return redirect()->route('home');
    }
}
