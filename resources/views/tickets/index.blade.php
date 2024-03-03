@extends('customer_names.layout')
<br/>
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1><i class="fas fa-ticket-alt"></i> Ticket</h1>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('tickets.create') }}">
                <i class="fas fa-plus"></i> Create New Ticket
            </a>            
        </div>        
    </div>
</div>
<hr>
<form action="" class="mt-3">
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label for="search">Search</label>
                <input type="text" name="search" id="" value="{{ old('search', Request::get('search')) }}" class="form-control" placeholder="Institute Name/Mobile No." />
            </div>
        </div>        
        <div class="col-md-6 col-lg-2">
            <div class="form-group">
                <label for="product">Product</label>
                <select name="product" class="form-control">
                    <option value="">All</option>
                    <option value="OMRsheet" {{ Request::get('product') === 'OMRsheet' ? 'selected' : '' }}>OMRsheet</option>
                    <option value="OScanner" {{ Request::get('product') === 'OScanner' ? 'selected' : '' }}>OScanner</option>
                    <option value="R A" {{ Request::get('product') === 'R A' ? 'selected' : '' }}>R A</option>
                </select>
            </div>
        </div>        
        <div class="col-md-6 col-lg-2">
            <div class="form-group">
                <label for="priority">Priority</label>
                <select name="priority" class="form-control">
                    <option value="">All</option>
                    <option value="Low" {{ Request::get('priority') === 'Low' ? 'selected' : '' }}>Low</option>
                    <option value="Medium" {{ Request::get('priority') === 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="High" {{ Request::get('priority') === 'High' ? 'selected' : '' }}>High</option>
                </select>
            </div>
        </div>        
        <div class="col-md-6 col-lg-2">
            <div class="form-group">
                <label for="ticket_status">Ticket Status</label>
                <select name="ticket_status" class="form-control">
                    <option value="">All</option>
                    <option value="Open" {{ Request::get('ticket_status') === 'Open' ? 'selected' : '' }}>Open</option>
                    <option value="Assigned" {{ Request::get('ticket_status') === 'Assigned' ? 'selected' : '' }}>Assigned</option>
                </select>
            </div>
        </div> 
        <div class="col-md-6 col-lg-2">
            <div class="form-group">
                <label for="assigned_to">Assigned To</label>
                <select name="assigned_to" class="form-control">
                    <option value="">All</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ Request::get('assigned_to') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>      
        <div class="col-md-6 col-lg-4 d-flex align-items-end">
            <button class="btn btn-success me-2">
                <i class="fas fa-search"></i> Search
            </button>
            <a href="{{ route('tickets.index') }}" class="btn btn-primary">
                <i class="fas fa-undo"></i> Reset
            </a>
        </div>
    </div>
</form>

@if ($message = Session::get('success'))
<div class="alert alert-success mt-3">
    <p>{{ $message }}</p>
</div>
@endif

<div class="table-responsive mt-3"><hr/>
    <table class="table table-bordered table-striped">
        <thead>
                <th>No</th>
                <th>Institue Name</th>
                <th>Mobile No.</th>
                <th>Product</th>
                <th>Issue</th>
                <th>Attachment</th>
                <th>Assigned</th>
                <th>Priority</th>
                <th>Ticket Status</th>
                <th style="width: 13%;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $ticket->institue_name }}</td>
                <td>{{ $ticket->mobile }}</td>
                <td>{{ $ticket->product }}</td>
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
                            <embed src="{{ asset('storage/' . $ticket->attachment) }}" type="application/pdf" width="150" height="150">
                        @else
                            <img src="{{ asset('storage/' . $ticket->attachment) }}" alt="Attachment" width="150" height="150">
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
                    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('tickets.show', $ticket->id) }}"><i class="fas fa-eye"></i></a>
                        <a class="btn btn-primary" href="{{ route('tickets.edit', $ticket->id) }}"><i class="fas fa-edit"></i></a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this ticket user?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{!! $tickets->links() !!}

@endsection
