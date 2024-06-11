@extends('admin.master')

@section('title', 'Pemesanan')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center">All Payments</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Booking ID</th>
                        <th scope="col">User</th>
                        <th scope="col">Room</th>
                        <th scope="col">Check-in Date</th>
                        <th scope="col">Check-out Date</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Proof of Payment</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $payment->booking->id }}</td>
                        <td>{{ $payment->booking->first_name }} {{ $payment->booking->last_name }}</td>
                        <td>{{ $payment->booking->room->name }}</td>
                        <td>{{ $payment->booking->checkin_date }}</td>
                        <td>{{ $payment->booking->checkout_date }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</td>
                        <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ asset('images/payment/' . $payment->proof_of_payment) }}" target="_blank">View</a>
                        </td>
                        <td>{{ ucfirst($payment->status) }}</td>
                        <td>
                            @if($payment->status == 'pending')
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveModal{{ $payment->id }}">
                                    Approve
                                </button>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#rejectModal{{ $payment->id }}">
                                    Reject
                                </button>
                            @elseif($payment->status == 'approved')
                                <button type="button" class="btn btn-success btn-sm" disabled>Approved</button>
                            @elseif($payment->status == 'rejected')
                                <button type="button" class="btn btn-warning btn-sm" disabled>Rejected</button>
                            @endif
                        </td>
                    </tr>
                    <!-- Approve Modal -->
                    <div class="modal fade" id="approveModal{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel{{ $payment->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="approveModalLabel{{ $payment->id }}">Approve Payment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to approve this payment?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('payments.approve', $payment->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success">Yes, Approve</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reject Modal -->
                    <div class="modal fade" id="rejectModal{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel{{ $payment->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="rejectModalLabel{{ $payment->id }}">Reject Payment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to reject this payment?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('payments.reject', $payment->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-warning">Yes, Reject</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $payments->links() }}
        </div>
    </div>
@endsection
