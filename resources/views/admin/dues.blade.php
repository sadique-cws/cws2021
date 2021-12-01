@extends('layouts.base')
@section('page_title',' | Dues Payments')
@section('css')
	<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css' ) }}" rel="stylesheet" />
@endsection
@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header border-0 d-flex">
                <div class="h5 pt-2">Dues Payment</div>
                <span class="mt-1 ms-auto"><a href="{{ route('message.all.students') }}" class="btn btn-dark btn-sm">Message All <i class="bx bx-envelope"></i></a></span>

            </div>
            <div class="card-body">
                <div class="table-responsive p-2">
                    <table id="example2" class="table p-2 table-borderless table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Student name</th>
                                <th>Dues Month</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dues as $due)
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
                                    <span class="badge bg-light-danger text-danger">{{ $due->status }}</span>
                                </td>
                                <td>₹ {{ $due->amount }}</td>
                                <td>
                                    <div class="d-flex d-print-none">
                                        <form action="{{ route('set.payment.paid') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="student_id" value="{{ $due->student_id }}">
                                            <input type="hidden" name="payment_id" value="{{ $due->payment_id }}">

                                            <button class="btn btn-sm bg-light-success text-success">₹ Paid</button>
                                        </form>
                                        <button class="btn btn-sm bg-light-primary ms-2 text-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $due->id }}"><i class="bx bx-edit"></i></button>
                                        <form action="{{ route('send.sms') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="student_id" value="{{ $due->student_id }}">
                                            <input type="hidden" name="dues_month" value="{{ $date->format('M') }}">
                                            <input type="hidden" name="dues_amount" value="{{ $due->amount }}">
                                            <button class="btn btn-sm bg-light-warning ms-2 text-warning"><i class="bx bx-envelope"></i></button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $due->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Dues Amount</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('update.dues.amount') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="payment_id" value="{{ $due->id }}">
                                                <div class="mb-3">
                                                    <label for="amount">Amount</label>
                                                    <input type="text" value="{{ $due->amount }}" name="amount" class="form-control shadow-sm" id="amount">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="submit" value="change amount" class="btn btn-dark float-end">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
