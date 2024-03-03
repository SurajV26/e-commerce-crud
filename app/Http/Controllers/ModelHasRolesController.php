<?php

namespace App\Http\Controllers;

use App\Models\ModelHasRoles;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class ModelHasRolesController extends Controller
// {
//     public function index()
//     {
//         $modelHasRoles = ModelHasRoles::all();
//         return view('model_has_roles.index', compact('modelHasRoles'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'role_id' => 'required|exists:roles,id',
//             'model_type' => 'required|string',
//             'model_id' => 'required|numeric',
//         ]);

//         $modelHasRoles = new ModelHasRoles();
//         $modelHasRoles->role_id = $request->input('role_id');
//         $modelHasRoles->model_type = User::class; // Set the User model's namespace
//         $modelHasRoles->model_id = $request->input('model_id');
//         $modelHasRoles->save();

//         return redirect()->route('model_has_roles.index')->with('success', 'ModelHasRoles created successfully');
//     }

// }