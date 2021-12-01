@extends('layouts.public')

@section('content')
    
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card text-center {{$bg}} shadow-sm">
                <div class="card-body">
                    <h1 class="display-6 text-white">{{$msg}}</h1>
                    <p class="lead">{{$details}}</p>
                    <a href="{{route('homepage')}}" class="btn btn-danger mt-4">Go at Homepage</a>      
                </div>
            </div>
        </div>
    </div>
</div>

@endsection