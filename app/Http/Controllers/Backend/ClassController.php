<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Classinfo;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classs = Classinfo::orderBy('id', 'desc')->get();
        return view('Backend.Pages.Class.index', compact('classs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Pages.Class.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $class = new Classinfo();
        $class->name = $request->class_name;
        $class->group_name = $request->group_name;
        $class->save();
        session()->flash('success', 'Class has been add successfully !!');
        return redirect()->route('class.create');
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
        $class = Classinfo::find($id);
        return view('Backend.Pages.Class.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $class = Classinfo::find($id);
        $class->name = $request->class_name;
        $class->group_name = $request->group_name;
        $class->save();
        session()->flash('success', 'Class has been updated successfully !!');
        return redirect()->route('class.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = Classinfo::find($id);
        if (!is_null($class)) {
            $class->delete();
        }
        session()->flash('success', 'Class has been deleted successfully !!');
        return redirect()->route('class.index');
    }
}
