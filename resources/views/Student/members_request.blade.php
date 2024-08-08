@extends('navbar.navbar_student')

@section('content')

    <div class="container mt-5" style="padding-top: 30px;">
        <h1 class="mt-4">Members' Requests</h1>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Number</th>
                        <th>Name</th>
                        <th>Organization</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $key => $payment)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $payment->studno }}</td>
                            <td>{{ $payment->name }}</td>
                            <td>{{ $payment->organization }}</td>
                            <td>{{ $payment->amount }}</td>
                            <td>
                                
                            <form action="{{ route('approvePayment', ['paymentId' => $payment->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                                <button class="btn btn-danger">Reject</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
