@extends('customer_names.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('usertickets.index') }}"><i class="fa fa-home"></i> Back</a>
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
  
    <form method="POST" action="{{ route('usertickets.update', $ticket->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Institue Name:<span class="required"> *</span></strong>
                    <input type="text" name="institue_name" value="{{ $ticket->institue_name }}" class="form-control" placeholder="Name">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Mobile No.:<span class="required"> *</span></strong>
                    <input type="number" name="mobile" value="{{ $ticket->mobile }}" class="form-control" placeholder="Mobile">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Product:<span class="required"> *</span></strong>
                    <select name="product" class="form-control">
                        <option value="">Select...</option>
                        <option value="OMRsheet"{{ old('product', $ticket->product) === 'OMRsheet' ? ' selected' : '' }}>OMRsheet</option>
                        <option value="OScanner"{{ old('product', $ticket->product) === 'OScanner' ? ' selected' : '' }}>OScanner</option>
                        <option value="RA"{{ old('product', $ticket->product) === 'RA' ? ' selected' : '' }}>R A</option>
                    </select>
                </div>
            </div>            

            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Priority:<span class="required"> *</span></strong>
                    <select name="priority" class="form-control">
                        <option value="Low"{{ old('priority') === 'Low' ? ' selected' : '' }}>Low</option>
                        <option value="Medium"{{ old('priority') === 'Medium' ? ' selected' : '' }}>Medium</option>
                        <option value="High"{{ old('priority') === 'High' ? ' selected' : '' }}>High</option>
                    </select>
                </div>
            </div> 
            
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Issue:</strong>
                    <textarea name="issue" class="form-control" placeholder="Issue" rows="2">{{ $ticket->issue }}</textarea>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-6">
                <strong>Attachment:</strong>
                <input type="file" name="attachment" id="attachment" value="1">
                <input type="hidden" name="old_attachment" value="{{ $ticket->attachment }}" class="form-control">
                
                @if (old('attachment') !== null) <!-- Check if a new attachment is provided during editing -->
                    @if (Str::endsWith(old('attachment'), ['.jpg', '.jpeg', '.png', '.gif', '.bmp']))
                        <img src="{{ asset('storage/' . old('attachment')) }}" width="100" height="120">
                    @elseif (Str::endsWith(old('attachment'), '.pdf'))
                        <a href="{{ asset('storage/' . old('attachment')) }}" target="_blank">View PDF</a>
                    @endif
                @elseif ($ticket->attachment) <!-- Display old attachment if no new attachment provided -->
                    @if (Str::endsWith($ticket->attachment, ['.jpg', '.jpeg', '.png', '.gif', '.bmp']))
                        <img src="{{ asset('storage/' . $ticket->attachment) }}" width="100" height="120">
                    @elseif (Str::endsWith($ticket->attachment, '.pdf'))
                        <a href="{{ asset('storage/' . $ticket->attachment) }}" target="_blank">View PDF</a>
                    @endif
                @endif
            </div>                 

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
            </div>
        </div>
    </form>
    @endsection
