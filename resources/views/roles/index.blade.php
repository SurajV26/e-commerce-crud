@extends('customer_names.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1><i class="fas fa-user-lock"></i> Role</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('roles.create') }}">
                    <i class="fas fa-plus"></i> Create New role
                </a>         
            </div>
        </div>
    </div>
<hr>
    <form action="" class="mt-3" style="padding-left: 20%" method="GET">
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
                <a href="{{ route('roles.index') }}" class="btn btn-primary">
                    <i class="fas fa-undo"></i> Reset</a>
            </div>
        </div>
    </form>

    @if ($message = Session::get('success'))
    <div class="alert alert-success mt-3">
        <p>{{ $message }}</p>
    </div>
    @endif
<hr>
    <div class="table-responsive mt-3">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th style="text-align: center;">ID</th>
                    <th style="text-align: center;">Name</th>
                    <th style="text-align: center;">Guard Name</th>
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->guard_name }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
