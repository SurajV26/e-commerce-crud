@extends('customer_names.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Party</h2>
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
   
<form action="{{ route('customer_names.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
  
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Customer Name:<span class="required"> *</span></strong>
                <input type="text" name="party_name" class="form-control" placeholder="Name" value="{{ old('party_name') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>City:<span class="required"> *</span></strong>
                <input type="text" name="location" class="form-control" placeholder="City" value="{{ old('location') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Billing Name:<span class="required"> *</span></strong>
                <input type="text" name="billing_name" class="form-control" placeholder="Billing Name" value="{{ old('billing_name') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Contact Person:<span class="required"> *</span></strong>
                <input type="text" name="contact_person" class="form-control" placeholder="Contact Person" value="{{ old('contact_person') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Contact Number:<span class="required"> *</span></strong>
                <input type="number" name="contact_number" class="form-control" placeholder="Contact Number" value="{{ old('contact_number') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Email Address:</strong>
                <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Executive Name:</strong>
                <input type="text" name="executive_name" class="form-control" placeholder="Executive Name" value="{{ old('executive_name') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>No. Of Licences:<span class="required"> *</span></strong>
                <input type="text" name="no_of_licenses" class="form-control" placeholder="No. Of Licences" value="{{ old('no_of_licenses') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>AMC Start Date:<span class="required"> *</span></strong>
                <input type="date" name="amc_start_date" class="form-control" value="{{ old('amc_start_date') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>AMC Expiry Date:<span class="required"> *</span></strong>
                <input type="date" name="amc_expiry_date" class="form-control" value="{{ old('amc_expiry_date') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Past AMC Charge(Exclusive GST):<span class="required"> *</span></strong>
                <input type="text" name="past_amc_charge" class="form-control" placeholder="Past AMC Charge(Exclusive GST)" value="{{ old('past_amc_charge') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>New Quoted AMC Charge(Exclusive GST):<span class="required"> *</span></strong>
                <input type="text" name="new_quoted_amc_charge" class="form-control" placeholder="New Quoted AMC Charge(Exclusive GST)"value="{{ old('new_quoted_amc_charge') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="payment_status">Payment Status:</label>
                <select class="form-control" id="payment_status" name="payment_status">
                    <option value="#" {{ old('payment_status') === '#' ? 'selected' : '' }}>Select...</option>
                    <option value="Done" {{ old('payment_status') === 'Done' ? 'selected' : '' }}>Done</option>
                    <option value="Pending" {{ old('payment_status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>
        </div>        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Address:</strong>
                <input type="text" name="address" class="form-control" placeholder="Address" value="{{ old('address') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection
