@extends('customer_names.layout')

@section('content')
<div class="container" style="padding-left: 20%">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header text-center bg-dark text-white">
                    <h2>User Details</h2>
                </div>
                <div class="card-body">
                    <div class="text-right">
                        <a href="{{ route('user.index') }}" class="btn btn-info"><i class="fa fa-home"></i> Back</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Name</th>
                                    <th style="text-align: center;">Date of Birth</th>
                                    <th style="text-align: center;">Mobile No.</th>
                                    <th style="text-align: center;">Email</th>
                                    <th style="text-align: center;">Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align: center;">{{ $user->name }}</td>
                                    <td style="text-align: center;">{{ !empty($user->dob) ? date('d-m-Y', strtotime($user->dob)) : 'N/A' }}</td>
                                    <td style="text-align: center;">
                                        @if ($user->mobile )
                                            {{ $user->mobile }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td style="text-align: center;">{{ $user->email }}</td>
                                    <td style="text-align: center;">{{ $user->roles->role->name }}</td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
