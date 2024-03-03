@extends('customer_names.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1><i class="fas fa-ticket-alt"></i> Ticket user</h1>
        </div>
        <div class="pull-right">
            <p>Welcome, {{ $user->name }}</p>
        </div>
    </div>
</div>
<hr>
@if ($message = Session::get('success'))
<div class="alert alert-success mt-3">
    <p>{{ $message }}</p>
</div>
@endif

<div class="table-responsive mt-3">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Institute Name</th>
                <th>Mobile No</th>
                <th>Product</th>
                <th>Issue</th>
                <th>Attachment</th>
                <th>Assigned</th>
                <th>Priority</th>
                <th>Ticket Status</th>
                <th style="width: 13%;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $key=> $ticket)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $ticket->institue_name ?? 'N/A' }}</td>
                <td>{{ $ticket->mobile ?? 'N/A'}}</td>
                <td>{{ $ticket->product ?? 'N/A' }}</td>
                <td>
                    @if ($ticket->issue)
                        {{ $ticket->issue }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if ($ticket->attachment)
                        @if (Str::contains($ticket->attachment, '.pdf'))
                            <embed src="{{ asset('storage/' . $ticket->attachment) }}" type="application/pdf" width="120" height="120">
                        @else
                            <img src="{{ asset('storage/' . $ticket->attachment) }}" alt="Attachment" width="120" height="120">
                        @endif
                    @else
                        <span>N/A</span>
                    @endif
                </td>
                <td>
                    @if ($ticket->assignedTo)
                        {{ $ticket->assignedTo->name }}
                    @else
                        N/A
                    @endif
                </td>
                <td>{{ $ticket->priority }}</td>
                <td>{{ $ticket->ticket_status }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('usertickets.show', $ticket->id) }}"><i class="fas fa-eye"></i></a>
                    <a class="btn btn-primary" href="{{ route('usertickets.edit', $ticket->id) }}"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('usertickets.destroy', $ticket->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this ticket user?')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $tickets->links() }}
@endsection
