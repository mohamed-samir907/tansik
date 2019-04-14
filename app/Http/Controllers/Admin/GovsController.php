<?php

namespace App\Http\Controllers\Admin;

use App\MyHelper;
use App\Model\Gov;
use App\Http\Requests\StoreGov;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GovsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $govs = Gov::paginate(20);

        return view('admin.govs.index', compact('govs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.govs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGov  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGov $request)
    {
        list($name) = MyHelper::sanitizeString($request->name);

        Gov::create([
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
        $gov = Gov::findOrFail($id);

        return view('admin.govs.edit', compact('gov'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreGov  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGov $request, $id)
    {
        $gov = Gov::findOrFail($id);
        list($name) = MyHelper::sanitizeString($request->name);

        $gov->name = $name;
        $gov->save();

        session()->flash('success', 'تم التعديل بنجاح');
        return redirect()->route('govs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gov = Gov::findOrFail($id);
        $gov->delete();

        session()->flash('success', 'تم الحذف بنجاح');
        return redirect()->route('govs.index');
    }
}
