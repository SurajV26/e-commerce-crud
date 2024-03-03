<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\ModelHasRoles;
use Illuminate\Pagination\Paginator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $role = $request->input('role');
        $users = User::query();
    
        if (!empty($search)) {
            $users->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
    
        if (!empty($role)) {
            $users->whereHas('roles', function ($query) use ($role) {
                $query->where('role_id', $role);
            });
        }
    
        $users = $users->with('roles.role')->paginate(5);
    
        $i = ($users->currentPage() - 1) * $users->perPage();
    
        $roles = Role::all();
    
        return view('user.index', compact('roles', 'users', 'i'));
    }    

    public function edit($id)
    {
        $user = User::with('roles')->find($id);
        
        if (!$user) {
            return redirect()->route('user.index')->with('error', 'User not found.');
        }

        $roles = Role::all();

        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'mobile' => 'required|numeric|digits:10',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string|max:255',
        ]);
    
        $user = User::find($id);
    
        if (!$user) {
            return redirect()->route('user.index')->with('error', 'User not found.');
        }
    
        $user->name = $request->input('name');
        $user->dob = $request->input('dob');
        $user->mobile = $request->input('mobile');
        $user->email = $request->input('email');
        $user->modelHasRoles()->update(['role_id' => $request->input('role')]);
        
        $user->save();
    
        return redirect()->route('user.index')->with('success', 'User details updated successfully');
    }
    
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'dob' => 'required|date',
    //         'mobile' => 'required|numeric|digits:10',
    //         'email' => 'required|email|unique:users,email,' . $id,
    //         'role' => 'required|string|max:255',
    //     ]);

    //     $user = User::find($id);

    //     if (!$user) {
    //         return redirect()->route('user.index')->with('error', 'User not found.');
    //     }

    //     $user->name = $request->input('name');
    //     $user->dob = $request->input('dob');
    //     $user->mobile = $request->input('mobile');
    //     $user->email = $request->input('email');
    //     $user->roles->update(['role_id' => $request->input('role')]);
    //     $user->save();

    //     return redirect()->route('user.index')->with('success', 'User details updated successfully');
    // }   
        
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('user.index')->with('error', 'User not found.');
        }

        return view('user.show', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('user.index')->with('error', 'User not found.');
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}