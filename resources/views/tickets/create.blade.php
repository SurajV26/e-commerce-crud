@extends('customer_names.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Ticket</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('tickets.index') }}"><i class="fa fa-home"></i> Back</a>
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
   
<form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
  
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Institue Name:<span class="required"> *</span></strong>
                <input type="text" name="institue_name" class="form-control" placeholder="Name..." value="{{ old('institue_name') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Mobile No.:<span class="required"> *</span></strong>
                <input type="number" name="mobile" class="form-control" placeholder="Mobile..." value="{{ old('mobile') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Product:<span class="required"> *</span></strong>
                <select name="product" class="form-control">
                    <option value="#"{{ old('product') === '#' ? ' selected' : '' }}>Select...</option>
                    <option value="OMRsheet"{{ old('product') === 'OMRsheet' ? ' selected' : '' }}>OMRsheet</option>
                    <option value="OScanner"{{ old('product') === 'OScanner' ? ' selected' : '' }}>OScanner</option>
                    <option value="RA"{{ old('product') === 'RA' ? ' selected' : '' }}>R A</option>
                </select>
            </div>
        </div>                
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Attachment:<span class="required"> *</span></strong>
                <input type="file" name="attachment" accept=".jpg, .jpeg, .png, .pdf" class="form-control" value="{{ old('attachment') }}">
            </div>
        </div>               
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <label for="assigned_to">Assigned To:<span class="required"> *</span></label>
                <select name="assigned_to" class="form-control">
                    <option value="">Select User</option>
                    @foreach($allUsers as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>                           
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Priority:<span class="required"> *</span></strong>
                <select name="priority" class="form-control">
                    <option value="#"{{ old('priority') === '#' ? ' selected' : '' }}>Select...</option>
                    <option value="Low"{{ old('priority') === 'Low' ? ' selected' : '' }}>Low</option>
                    <option value="Medium"{{ old('priority') === 'Medium' ? ' selected' : '' }}>Medium</option>
                    <option value="High"{{ old('priority') === 'High' ? ' selected' : '' }}>High</option>
                </select>
            </div>
        </div>        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Issue:</strong>
                <textarea name="issue" class="form-control" placeholder="Issue..." rows="2">{{ old('issue') }}</textarea>
            </div>
        </div>                   
        {{-- <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Ticket Status:<span class="required"> *</span></strong>
                <input type="text" name="ticket_status" class="form-control" placeholder="Ticket Status" value="{{ old('ticket_status', 'open') }}">
            </div>
        </div>                --}}
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection
