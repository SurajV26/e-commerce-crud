@extends('customer_names.layout')

@section('content')
<style>
    .pdf-page {
        width: 100%;
        padding: 20px;
        border: 1px solid #000;
    }

    .pdf-table {
        width: 100%;
    }

    .pdf-table th, .pdf-table td {
        border: 1px solid #000;
        padding: 8px;
    }

    .pdf-table th {
        background-color: #f2f2f2;
    }
</style>

<div class="pdf-page">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Details</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('usertickets.index') }}"><i class="fa fa-home"></i> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <table class="pdf-table">
                <tbody>
                    <tr>
                        <th>Institue Name</th>
                        <td>{{ $ticket->institue_name }}</td>
                    </tr>
                    <tr>
                        <th>Mobile No.</th>
                        <td>{{ $ticket->mobile }}</td>
                    </tr>
                    <tr>
                        <th>Product</th>
                        <td>{{ $ticket->product }}</td>
                    </tr>
                    <tr>
                        <th>Issue</th>
                        <td>{{ $ticket->issue }}</td>
                    </tr>
                    <tr>
                        <th>Assigned</th>
                        <td>
                            @if ($ticket->assignedTo)
                                {{ $ticket->assignedTo->name }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>                    
                    <tr>
                        <th>Priority</th>
                        <td>{{ $ticket->priority }}</td>
                    </tr>
                    <tr>
                        <th>Ticket Status</th>
                        <td>{{ $ticket->ticket_status }}</td>
                    </tr>
                    <tr>
                        <th>Attachment</th>
                        <td>
                            @if (pathinfo($ticket->attachment, PATHINFO_EXTENSION) == 'pdf')
                                <a href="{{ asset('storage/' . $ticket->attachment) }}" target="_blank">View PDF</a>
                            @else
                                <img src="{{ asset('storage/' . $ticket->attachment) }}" width="100" height="120">
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
