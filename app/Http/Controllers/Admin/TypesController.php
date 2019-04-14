<?php

namespace App\Http\Controllers\Admin;

use App\MyHelper;
use App\Model\Type;
use App\Http\Requests\StoreType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::paginate(20);

        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreType  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreType $request)
    {
        list($name) = MyHelper::sanitizeString($request->name);

        Type::create([
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
        $type = Type::findOrFail($id);

        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreType  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreType $request, $id)
    {
        $type = Type::findOrFail($id);
        list($name) = MyHelper::sanitizeString($request->name);

        $type->name = $name;
        $type->save();
        
        session()->flash('success', 'تم التعديل بنجاح');
        return redirect()->route('types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $types = Type::findOrFail($id);
        $types->delete();

        session()->flash('success', 'تم الحذف بنجاح');
        return redirect()->route('types.index');
    }
}
