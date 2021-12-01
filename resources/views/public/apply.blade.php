@extends('layouts.public')

@section('content')
    
<div class="container mt-5">
    <div class="row">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent">
                <h5>Apply for Admission</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('add.student') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control rounded shadow-sm">
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-6">
                            <label for="mother_name">Mother Name</label>
                            <input type="text" name="mother_name" value="{{ old('mother_name') }}" id="mother_name" class="form-control rounded shadow-sm">
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="father_name">Father Name</label>
                            <input type="text" name="father_name" value="{{ old('father_name') }}" id="father_name" class="form-control rounded shadow-sm">
                        </div>
                    </div>
                   <div class="row">
                        <div class="mb-3 col-lg-6">
                            <label for="contact">Contact</label>
                            <input type="number" name="contact" value="{{ old('contact') }}" id="contact" class="form-control rounded shadow-sm">
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control rounded shadow-sm">
                        </div>
                   </div>
                   <div class="row mb-3">
                        <div class="col">
                            <label for="education">Education</label>
                            <input type="text" name="education" value="{{ old('education') }}" class="form-control shadow-sm" id="eductaion">
                        </div>
                        <div class="col">
                            <label for="dob">Date of Birth</label>
                            <input type="date"  name="dob" value="{{ old('dob') }}"  class="form-control shadow-sm" id="dob">
                        </div>
                        <div class="col">
                            <label for="education">Gender</label>
                            <select name="gender" id="gender" class="form-select">
                                <option value="" selected hidden disabled></option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                   </div>
                   <div class="mb-3">
                       <label for="address">Address</label>
                       <textarea name="address" id="address" cols="30" rows="6" class="form-control"></textarea>
                   </div>
                   <div class="mb-3">
                       <button class="btn btn-dark w-100">Add</button>
                   </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection