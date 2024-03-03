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
                <h2>Role Details</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('roles.index') }}"><i class="fa fa-home"></i> Back to Roles</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <table class="pdf-table">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $role->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $role->name }}</td>
                    </tr>
                    <tr>
                        <th>Guard Name</th>
                        <td>{{ $role->guard_name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
