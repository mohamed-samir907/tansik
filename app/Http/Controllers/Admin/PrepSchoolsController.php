<?php

namespace App\Http\Controllers\Admin;

use App\MyHelper;
use App\Model\Section;
use App\Model\PrimarySchool as Prep;
use App\Http\Requests\StorePrepSchool;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrepSchoolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = Prep::paginate(20);

        return view('admin.p-schools.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::all();

        return view('admin.p-schools.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePrepSchool  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrepSchool $request)
    {
        list($name) = MyHelper::sanitizeString($request->name);

        Prep::create([
            'section_id' => $request->section,
            'name' => $name,
            'gender' => $request->gender
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
        $school  = Prep::findOrFail($id);
        $sections   = Section::all();

        return view('admin.p-schools.edit', compact('school', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StorePrepSchool  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePrepSchool $request, $id)
    {
        $school = Prep::findOrFail($id);
        list($name) = MyHelper::sanitizeString($request->name);

        $school->name = $name;
        $school->section_id = $request->section;
        $school->gender = $request->gender;
        $school->save();

        session()->flash('success', 'تم التعديل بنجاح');
        return redirect()->route('p-schools.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = Prep::findOrFail($id);
        $school->delete();

        session()->flash('success', 'تم الحذف بنجاح');
        return redirect()->route('p-schools.index');
    }
}
