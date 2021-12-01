@extends('layouts.base')
@section('page_title',' | Paid Payments')
{{-- @section('students','mm-active') --}}
@section('css')
	<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css' ) }}" rel="stylesheet" />
@endsection
@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 d-flex">
                <div class="h5 pt-2">Dues Payment</div>
            </div>
            <div class="card-body">
                <div class="table-responsive p-2">
                    <table id="example2" class="table p-2 table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Student name</th>
                                <th>Dues Month</th>
                                <th>Payment Date</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paid as $due)
                            <tr>
                                <td>{{ $due->id }}</td>
                                <td>{{ $due->student->name }}</td>
                                <td>
                                    @php
                                        $date = new DateTime($due->dues_month);
                                        echo $date->format('d M Y');
                                    @endphp
                                </td>
                                <td>
                                    @php
                                        $date = new DateTime($due->payment_date);
                                        echo $date->format('d M Y');
                                    @endphp
                                </td>
                                <td>
                                    <span class="badge bg-light-success text-success">{{ $due->status }}</span>
                                </td>
                                <td>₹ {{ $due->amount }}</td>
                                <td>
                                    <div class="d-flex d-print-none">
                                        <form action="{{ route('set.payment.unpaid') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="student_id" value="{{ $due->student_id }}">
                                            <input type="hidden" name="payment_id" value="{{ $due->payment_id }}">

                                            <button class="btn btn-sm bg-light-danger text-danger">Unpaid</button>
                                        </form>
                                        {{-- <button class="btn btn-sm bg-light-primary ms-2 text-primary"><i class="bx bx-edit"></i></button> --}}
                                        {{-- <button class="btn btn-sm bg-light-warning ms-2 text-warning"><i class="bx bx-envelope"></i></button> --}}
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
