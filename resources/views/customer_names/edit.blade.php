@extends('customer_names.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Party</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('customer_names.index') }}"><i class="fa fa-home"></i> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form method="POST" action="{{ route('customer_names.update', $customer_name->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Customer Name:</strong>
                    <input type="text" name="party_name" value="{{ $customer_name->party_name }}" class="form-control" placeholder="Name">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>City:</strong>
                    <input type="text" name="location" value="{{ $customer_name->location }}" class="form-control" placeholder="City">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Billing Name:</strong>
                    <input type="text" name="billing_name" value="{{ $customer_name->billing_name }}" class="form-control" placeholder="Billing Name">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Contact Person:</strong>
                    <input type="text" name="contact_person" value="{{ $customer_name->contact_person }}" class="form-control" placeholder="Contact Person">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Contact Number:</strong>
                    <input type="number" name="contact_number" value="{{ $customer_name->contact_number }}" class="form-control" placeholder="Contact Number">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Email Address:</strong>
                    <input type="email" name="email" value="{{ $customer_name->email }}" class="form-control" placeholder="Email Address">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Executive Name:</strong>
                    <input type="text" name="executive_name" value="{{ $customer_name->executive_name }}" class="form-control" placeholder="Executive Name">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>No. Of Licences:</strong>
                    <input type="text" name="no_of_licenses" value="{{ $customer_name->no_of_licenses }}" class="form-control" placeholder="No. Of Licences">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="amc_start_date">AMC Start Date:</label>
                    <input type="date" name="amc_start_date" class="form-control" value="{{ old('amc_start_date', $customer_name->amc_start_date) }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="amc_expiry_date">AMC Expiry Date:</label>
                    <input type="date" name="amc_expiry_date" class="form-control" value="{{ old('amc_expiry_date', $customer_name->amc_expiry_date) }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Past AMC Charge(Exclusive GST):</strong>
                    <input type="text" name="past_amc_charge" value="{{ $customer_name->past_amc_charge }}" class="form-control" placeholder="Past AMC Charge(Exclusive GST)">
                </div>
            </div>            

            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>New Quoted AMC Charge(Exclusive GST):</strong>
                    <input type="text" name="new_quoted_amc_charge" value="{{ $customer_name->new_quoted_amc_charge }}" class="form-control" placeholder="New Quoted AMC Charge(Exclusive GST)">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="payment_status">Payment Status:</label>
                    <select class="form-control" id="payment_status" name="payment_status">
                        <option value="Done" {{ $customer_name->payment_status === 'Done' ? 'selected' : '' }}>Done</option>
                        <option value="Pending" {{ $customer_name->payment_status === 'Pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Address:</strong>
                    <input type="text" name="address" value="{{ $customer_name->address }}" class="form-control" placeholder="Address">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
            </div>
        </div>
    </form>
@endsection
