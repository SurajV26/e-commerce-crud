<?php

namespace App\Http\Controllers;

use App\Models\user;
use App\Models\Role;
use App\Models\ModelHasRoles;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    public function create()
    {
        $roles = Role::all();
        // dd($roles);
        return view('register', compact('roles'));
    }


    public function store(Request $request)
{
    try {


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'mobile' => 'required|numeric|digits:10',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string|max:255',
        ]);
 
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }   

        $register = new User();
        $register->name = $request->input('name');
        $register->dob = $request->input('dob');
        $register->mobile = $request->input('mobile'); 
        $register->email = $request->input('email');
        $register->password = bcrypt($request->input('password'));
        //$register->role = $request->input('role');

        $register->save();

        $modelHasRoles = new ModelHasRoles();
        $modelHasRoles->role_id = $request->input('role');
        $modelHasRoles->model_type = User::class;
        $modelHasRoles->model_id = $register->id;
        $modelHasRoles->save();    

        return redirect()->route('user.index')->with('success', 'Registration successful!');
        }
        catch (\Exception $e) {
        die($e->getMessage() . ' line '.$e->getLine());
        return redirect()->back()->with('error', 'Registration failed. Please try again later.');
        }
}

}
