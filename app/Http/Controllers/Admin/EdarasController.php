<?php

namespace App\Http\Controllers\Admin;

use App\MyHelper;
use App\Model\Gov;
use App\Model\Edara;
use App\Http\Requests\StoreEdara;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EdarasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $edaras = Edara::paginate(20);

        return view('admin.edaras.index', compact('edaras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $govs = Gov::all();

        return view('admin.edaras.create', compact('govs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEdara  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEdara $request)
    {
        list($name) = MyHelper::sanitizeString($request->name);

        Edara::create([
            'gov_id' => $request->modria,
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
        $edara  = Edara::findOrFail($id);
        $govs   = Gov::all();

        return view('admin.edaras.edit', compact('edara', 'govs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreEdara  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEdara $request, $id)
    {
        $edara = Edara::findOrFail($id);
        list($name) = MyHelper::sanitizeString($request->name);

        $edara->name = $name;
        $edara->gov_id = $request->modria;
        $edara->save();

        session()->flash('success', 'تم التعديل بنجاح');
        return redirect()->route('edaras.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $edara = Edara::findOrFail($id);
        $edara->delete();

        session()->flash('success', 'تم الحذف بنجاح');
        return redirect()->route('edaras.index');
    }
}
