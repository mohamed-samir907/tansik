<?php

namespace App\Http\Controllers\Admin;

use App\MyHelper;
use App\Model\Type;
use App\Model\Section;
use App\Model\SecondarySchool as Secondary;
use App\Http\Requests\StoreSecondarySchool;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SecondSchoolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = Secondary::paginate(20);

        return view('admin.s-schools.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections   = Section::all();

        return view('admin.s-schools.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSecondarySchool  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSecondarySchool $request)
    {
        list($name) = MyHelper::sanitizeString($request->name);
        list($degree) = MyHelper::sanitizeFloat($request->degree);

        Secondary::create([
            'section_id'    => $request->section,
            'name'          => $name,
            'gender'        => $request->gender,
            'type'          => $request->type,
            'degree'        => $degree
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
     */
    public function edit($id)
    {
        $school     = Secondary::findOrFail($id);
        $sections   = Section::all();

        return view('admin.s-schools.edit', compact('school', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreSecondarySchool  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSecondarySchool $request, $id)
    {
        $school = Secondary::findOrFail($id);
        list($name) = MyHelper::sanitizeString($request->name);
        list($degree) = MyHelper::sanitizeFloat($request->degree);

        $school->name       = $name;
        $school->section_id = $request->section;
        $school->gender     = $request->gender;
        $school->type       = $request->type;
        $school->degree     = $degree;
        $school->save();

        session()->flash('success', 'تم التعديل بنجاح');
        return redirect()->route('s-schools.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = Secondary::findOrFail($id);
        $school->delete();

        session()->flash('success', 'تم الحذف بنجاح');
        return redirect()->route('s-schools.index');
    }
}
