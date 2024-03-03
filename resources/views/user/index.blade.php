@extends('customer_names.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1><i class="fas fa-user"></i> Users</h1>
        </div>
        <div class="text-right" style="margin-bottom: 15px;">
            <a href="{{ route('register.create') }}" class="btn btn-warning"><i class="fas fa-user-plus"></i> Add User</a>
        </div>
    </div>
</div>
<hr>
<form action="{{ route('user.index') }}" class="mt-3" style="padding-left: 10%">
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label for="search" style="margin-left: 8%">Search</label>
                <input type="text" name="search" id="search" value="{{ Request::get('search') }}" class="form-control" placeholder="Search here....." />
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label for="role" style="margin-left: 8%">Role</label>
                <select name="role" class="form-control">
                    <option value="">All</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ Request::get('role') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>         
        <div class="col-md-6 col-lg-4 d-flex align-items-end" style="margin-top: 30px">
            <button type="submit" class="btn btn-success me-2">
                <i class="fas fa-search"></i> Search
            </button>
            <a href="{{ route('user.index') }}" class="btn btn-primary">
                <i class="fas fa-undo"></i> Reset
            </a>
        </div>
    </div>
</form>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<hr/>
<div class="table-responsive mt-3" style="text-align: center;">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Name</th>
                <th style="text-align: center;">Date of Birth</th>
                <th style="text-align: center;">Mobile No.</th>
                <th style="text-align: center;">Email</th>
                <th style="text-align: center;">Role</th>
                <th style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ !empty($user->dob) ? date('d-m-Y', strtotime($user->dob)) : 'N/A' }}</td>
                <td style="text-align: center;">
                    @if ($user->mobile)
                        {{ $user->mobile }}
                    @else
                        N/A
                    @endif
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->roles->role->name }}</td>
                {{-- <td>
                    @if ($user->roles)
                        {{ $user->roles->role->name }}
                    @else
                        No Role Assigned
                    @endif
                </td> --}}
                {{-- <td>
                    @foreach($user->roles as $role)
                        {{ $role->role->name }}
                    @endforeach
                </td> --}}
                {{-- <td>
                    @foreach($user->roles as $role)
                        @if ($role->role)
                            {{ $role->role->name }}
                        @else
                            Role not found
                        @endif
                    @endforeach
                </td> --}}                                                                         
                <td>
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('user.show', $user->id) }}"><i class="fas fa-eye"></i></a>
                        <a class="btn btn-info" href="{{ route('user.edit', $user->id) }}"><i class="fas fa-edit"></i></a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fas fa-trash-alt"></i></button>
                    </form>                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{!! $users->links() !!}

@endsection
