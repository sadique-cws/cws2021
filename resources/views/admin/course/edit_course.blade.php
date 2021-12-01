@extends('layouts.base')
@section('page_title',' | Dashboard')
@section('add_student','mm-active')
@section('content')

<style>
    label{
        font-weight: bold
    }
</style>
    <div class="container">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent">
                <h5>Add Course</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('course.update',['course'=>$course]) }}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="title">title</label>
                        <input type="text" name="title" value="{{ $course->title }}" id="title" class="form-control rounded shadow-sm">
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-6">
                            <label for="duration">duration</label>
                            <input type="text" name="duration" value="{{ $course->duration }}" id="duration" class="form-control rounded shadow-sm">
                        </div>
                        <div class="mb-3 col-lg-6">tr4t 
                            <label for="instructor">instructor</label>
                            <input type="text" name="instructor" value="{{$course->instructor}}" id="instructor" class="form-control rounded shadow-sm">
                        </div>
                    </div>
                   <div class="row"> 
                        <div class="mb-3 col-lg-6">
                            <label for="fee">fee</label>
                            <input type="text" name="fee" value="{{ $course->fee }}" id="fee" class="form-control rounded shadow-sm">
                        </div>
                        
                        <div class="col">
                            <label for="discounted_fee">discounted_fee</label>
                            <input type="text" name="discount_fee" value="{{ $course->discount_fee }}" class="form-control shadow-sm" id="discounted_fee">
                        </div>
                   </div>
                   <div class="row mb-3">
                       
                        <div class="col">
                            <label for="image">Image</label>
                            <input type="file"  name="image"  class="form-control shadow-sm" id="image">
                        </div>
                       
                   </div>
                   <div class="mb-3">
                       <label for="description">description</label>
                       <textarea name="description" id="summary-ckeditor" name="summary-ckeditor" id="description" cols="30" rows="6" class="form-control">{{$course->description}}</textarea>
                   </div>
                   <div class="mb-3">
                       <button class="btn btn-dark w-100">Add</button>
                   </div>
                </form>
            </div>
        </div>
    </div>
@endsection
