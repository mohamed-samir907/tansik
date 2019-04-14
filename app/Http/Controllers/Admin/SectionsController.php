<?php

namespace App\Http\Controllers\Admin;

use App\MyHelper;
use App\Model\Edara;
use App\Model\Section;
use App\Http\Requests\StoreSection;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::paginate(20);

        return view('admin.sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edaras = Edara::all();

        return view('admin.sections.create', compact('edaras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSection  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSection $request)
    {
        list($name) = MyHelper::sanitizeString($request->name);

        Section::create([
            'edara_id' => $request->edara,
            'name' => $name
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
        $section  = Section::findOrFail($id);
        $edaras   = Edara::all();

        return view('admin.sections.edit', compact('section', 'edaras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreSection  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSection $request, $id)
    {
        $section = Section::findOrFail($id);
        list($name) = MyHelper::sanitizeString($request->name);

        $section->name = $name;
        $section->edara_id = $request->edara;
        $section->save();

        session()->flash('success', 'تم التعديل بنجاح');
        return redirect()->route('sections.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        $section->delete();

        session()->flash('success', 'تم الحذف بنجاح');
        return redirect()->route('sections.index');
    }
}
