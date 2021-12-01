@extends('layouts.base')
@section('page_title',' | students')
@section('students','mm-active')
@section('css')
	<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css' ) }}" rel="stylesheet" />
@endsection
@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 d-flex">
                <div class="h5 pt-2">Students</div>
                <span class="d-flex ms-auto"><a href="" class="btn btn-dark ">Add new Student</a></span>
            </div>
            <div class="card-body">
                <div class="table-responsive p-2">
                    <table id="example2" class="table p-2 table-borderless table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Father name</th>
                                <th>Email</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Phone no</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->father_name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->gender }}</td>
                                @php
                                    $date = strtotime($student->created_at);
                                    $new_date = date('d-M-Y',$date)
                                @endphp
                                <td>{{ $new_date }}</td>
                                <td>{{ $student->contact }}</td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="javascript:;" class="text-danger bg-light-danger border-0"><i class="bx bxs-trash"></i></a>
                                        <a href="javascript:;" class="ms-4 text-primary bg-light-primary border-0"><i class="bx bxs-edit"></i></a>
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
