@extends('customer_names.layout')
<br/>
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1><i class="fas fa-users"></i> Customer</h1>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('customer_names.create') }}">
                <i class="fas fa-plus"></i> Create New Customer
            </a>            
        </div>
    </div>
</div>
<hr>
<form action="" class="mt-3" style="padding-left: 20%">
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label for="search" style="margin-left: 8%">Search</label>
                <input type="text" name="search" id="" value="{{ Request::get('search') }}" class="form-control" placeholder="Search here....." />
            </div>
        </div>
        <div class="col-md-6 col-lg-4 d-flex align-items-end" style="margin-top: 30px">
            <button class="btn btn-success me-2">
                <i class="fas fa-search"></i> Search</button>
            <a href="{{ route('customer_names.index') }}" class="btn btn-primary">
                <i class="fas fa-undo"></i> Reset</a>
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
                <th>Customer Name</th>
                <th>City</th>
                <th>Billing Name</th>
                <th>Contact Number</th>
                <th>Email Address</th>
                <th>No. Of Licences</th>
                <th>AMC Expiry Date</th>
                <th>AMC Status</th>
                <th>Payment Status</th>
                <th style="width: 13%;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($party_names as $party_name)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $party_name->party_name }}</td>
                <td>{{ $party_name->location }}</td>
                <td>{{ $party_name->billing_name }}</td>
                <td>{{ $party_name->contact_number }}</td>
                <td>{{ $party_name->email }}</td>
                <td>{{ $party_name->no_of_licenses }}</td>
                <td>{{ !empty($party_name->amc_expiry_date) ? date('d-m-Y', strtotime($party_name->amc_expiry_date)) : 'N/A' }}</td>
                <td>{{ $party_name->amc_status }}</td>
                <td>{{ $party_name->payment_status }}</td>
                <td>
                    <form action="{{ route('customer_names.destroy', $party_name->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('customer_names.show', $party_name->id) }}"><i class="fas fa-eye"></i></a>
                        <a class="btn btn-primary" href="{{ route('customer_names.edit', $party_name->id) }}"><i class="fas fa-edit"></i></a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Party?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{!! $party_names->links() !!}

@endsection
