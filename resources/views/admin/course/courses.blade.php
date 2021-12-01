@extends('layouts.base')
@section('page_title',' | students')
@section('course','mm-active')
@section('css')
	<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css' ) }}" rel="stylesheet" />
@endsection
@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 d-flex">
                <div class="h5 pt-2">Courses</div>
                <span class="d-flex ms-auto"><a href="{{route('course.create')}}" class="btn btn-dark ">Add new Course</a></span>
            </div>
            <div class="card-body">
                <div class="table-responsive p-2">
                    <table id="example2" class="table p-2 table-borderless table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Instructor</th>
                                <th>Fee</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                            <tr>
                                <td>{{ $course->title }}</td>
                                <td>{{ $course->instructor }}</td>
                                <td>{{ $course->fee }}</td>
                                <td>{{ $course->duration }}</td>
                                <td>{{ $course->status }}</td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <form action="{{route('course.destroy',['course'=>$course])}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="text-danger bg-light-danger border-0">
                                                    <i class="bx bxs-trash"></i>
                                            </button>
                                        </form>
                                        <a href="{{route('course.edit',['course'=>$course])}}" class="ms-4 text-primary bg-light-primary border-0"><i class="bx bxs-edit"></i></a>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
	<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );

			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>
@endsection
