<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.course.courses',['courses'=>Course::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.course.add_course');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $data = $request->validate([
            'title' => 'required',
            'duration' => 'required',
            'instructor' => 'required',
            'fee' => 'required',
            'discount_fee' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            'description' => 'required',
        ]);

        $filenamewithextension = $request->file('image')->getClientOriginalName();
        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        //get file extension
        $extension = $request->file('image')->getClientOriginalExtension();
        //filename to store
        $filenametostore = $filename.'_'.time().'.'.$extension;
        //Upload File
        $request->file('image')->storeAs('public/uploads/course/', $filenametostore);

        $course = new Course();
        $course->title = $request->title;
        $course->duration = $request->duration;
        $course->instructor = $request->instructor;
        $course->fee = $request->fee;
        $course->discount_fee = $request->discount_fee;
        $course->image = $filenametostore;
        $course->description = $request->description;
        $course->save();

        return redirect()->route('course.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('admin/course/edit_course',['course'=>$course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'title' => 'required',
            'duration' => 'required',
            'instructor' => 'required',
            'fee' => 'required',
            'discount_fee' => 'required',
            'description' => 'required',
        ]);

        $course->title = $request->title;
        $course->duration = $request->duration;
        $course->instructor = $request->instructor;
        $course->fee = $request->fee;
        $course->discount_fee = $request->discount_fee;
        $course->description = $request->description;
        $course->save();

        return redirect()->route('course.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
        $data = $course;
        $data->delete();
        return redirect()->route('course.index');


    }
}
