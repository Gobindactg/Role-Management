<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->get();
        return view('Backend.Blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blogs = Blog::orderBy('id', 'desc')->get();
        return view('Backend.Blog.create', compact('blogs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $user_id = Auth::id();
		$blog = new Blog();
        $blog->title = $request->title;
        $blog->description = $request->description;
        if ($request->hasFile('image')) {
			//   //insert that image
			$image = $request->file('image');
			$img = time() . '.' . $image->getClientOriginalExtension();
			$location = public_path('BlogImage/' . $img);
			Image::make($image)->save($location);
			$blog->image = $img;
          
			
		} 
        if($request->hasFile('vedio')){

            $file = $request->file('vedio');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path().'/BlogVedio/';
            $blog->vedio = $filename;
            
            return $file->move($path, $filename);
            
        }
      

        $blog->user_id = 1;
       
        $blog->save();
        session()->flash('success', 'Record Has Been Added Successfully');
        return redirect()->route('blog.create');
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
        //
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
    //     $blog = Blog::findById($id);

    //     if (!is_null($blog)) {
    //         $blog->delete();
    //     }
    //     session()->flash('success', 'Blog has been deleted !!');
    //     return redirect()->route('blog.index');
    // }
}
}