<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use File;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::orderBy('id', 'desc')->get();
        return view('Backend.Pages.Teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Pages.Teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $teachers =  new Teacher();
        $teachers->name = $request->name;
        $teachers->designation = $request->designation;
        $teachers->email = $request->email;
        $teachers->phone_number = $request->phone_number;
        $teachers->education_degree = $request->education;
        $teachers->subject = $request->subject;

        if ($request->hasFile('image')) {
            //   //insert that image

            $image = $request->file('image');
            $img = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('TeacherImage/' . $img);
            Image::make($image)->save($location);
            $teachers->image = $img;
        }

        $teachers->about = $request->about;
        $teachers->save();

        session()->flash('success', 'New Teacher Hass Been Added Succefully !!');
        return redirect()->route('teacher.create');
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
        $teacher = Teacher::find($id);

        return view('Backend.Pages.Teacher.edit', compact('teacher'));
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
        $teachers = Teacher::find($id);
        $teachers->name = $request->name;
        $teachers->designation = $request->designation;
        $teachers->email = $request->email;
        $teachers->phone_number = $request->phone_number;
        $teachers->education_degree = $request->education;
        $teachers->subject = $request->subject;

        if ($request->hasFile('image')) {
           
            //   to delete old image
            if (File::exists('TeacherImage/' . $teachers->image)) {
                File::delete('TeacherImage/' . $teachers->image);
            }

            //   //insert that image

            $image = $request->file('image');
            $img = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('TeacherImage/' . $img);
            Image::make($image)->save($location);
            $teachers->image = $img;
        }

        $teachers->about = $request->about;
        $teachers->save();

        session()->flash('success', 'New Teacher Update Been Added Succefully !!');
        return redirect()->route('teacher.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $teachers = Teacher::find($id);
       $teachers->is_delete = 0;
       $teachers->save();
       session()->flash('success', 'Teacher Hass Been Added Succefully !!');
       return redirect()->route('teacher.index');
    }
}
