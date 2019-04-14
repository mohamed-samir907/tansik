<?php

namespace App\Http\Controllers\Admin;

use App\MyHelper;
use App\User;
use App\Model\Gov;
use App\Model\Edara;
use App\Model\Section;
use App\Model\PrimarySchool as School;
use App\Model\Student;
use App\Http\Requests\StoreStudent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(20);

        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modrias = Gov::all();

        return view('admin.students.create', compact('modrias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudent  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudent $request)
    {
        list($name, $notes, $phone, $address) = MyHelper::sanitizeString($request->name, $request->notes, $request->phone, $request->address);
        list($s_number, $s_code, $national_id)     = MyHelper::sanitizeInteger($request->s_number,
             $request->s_code, $request->national_id);
        
        list($arabic, $english, $dersat, $al_gebra, $handsa, $total_math, $science, $total, $deen, $art, $computer)
            = MyHelper::sanitizeFloat($request->arabic, $request->english, $request->dersat, $request->al_gebra,
                $request->handsa, $request->total_math, $request->science, $request->total, $request->deen,
                $request->art, $request->computer);
        
        $student = Student::create([
            'school_id'         => $request->school,
            's_number'          => $s_number,
            's_code'            => $s_code,
            'national_id'       => $national_id,
            'phone'             => $phone,
            'address'           => $address,
            'name'              => $name,
            'system'            => $request->system,
            'gender'            => $request->gender,
            'arabic'            => $arabic,
            'english'           => $english,
            'dersat'            => $dersat,
            'al_gebra'          => $al_gebra,
            'handsa'            => $handsa,
            'total_math'        => $total_math,
            'science'           => $science,
            'total'             => $total,
            'deen'              => $deen,
            'art'               => $art,
            'computer'          => $computer,
            'notes'             => $notes            
        ]);

        User::create([
            'email' => $student->s_number,
            'password' => bcrypt($student->s_code),
            'name' => $student->name
        ]);

        session()->flash('success', 'تم الاضافة بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudent  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreStudent $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get the edara by modria id
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_edaras(Request $request)
    {
        $this->validate($request, [
            'modria' => 'bail|required|exists:govs,id'
        ]);

        $modria = $request->modria;

        $edaras = Edara::where('gov_id', $modria)->get();
        return response([
            'status'    => true,
            'edaras'    => $edaras
        ]);
    }

    /**
     * Get the sections by edara id
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_sections(Request $request)
    {
        $this->validate($request, [
            'edara' => 'bail|required|exists:edaras,id'
        ]);

        $edara = $request->edara;

        $edaras = Section::where('edara_id', $edara)->get();
        return response([
            'status'    => true,
            'edaras'    => $edaras
        ]);
    }

    /**
     * Get the sections by edara id
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_schools(Request $request)
    {
        $this->validate($request, [
            'section' => 'bail|required|exists:sections,id'
        ]);

        $modria = $request->section;

        $edaras = School::where('section_id', $modria)->get();
        return response([
            'status'    => true,
            'edaras'    => $edaras
        ]);
    }
}
