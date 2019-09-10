@extends('layout')
@section('content')

<div class="row">
    <div class="col-md-6">
        <h1>Repayment Schedules</h1>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Payment No</th>
            <th>Date</th>
            <th>Payment Amount</th>
            <th>Principle</th>
            <th>Interest</th>
            <th>Balance</th>
        </tr>
    </thead>
    <tbody>
        @foreach($repayments as $repayment)
        <tr>
            <td>{{ $repayments->paymentNo }}</td>
            <td>{{ $repayments->date }} </td>
            <td>{{ $repayments->paymentAmount }}</td>
            <td>{{ $repayments->principle }} </td>
            <td>{{ $repayments->interest }}</td>
            <td>{{ $repayments->balance }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>

    </tfoot>
</table>
{{ $repayments->links() }}

@endsection
