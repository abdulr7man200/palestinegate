<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Models\Role;
use App\Models\User;

class UsersController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        $roles = Role::all();

        return $dataTable->render('admin.users.index', compact('roles'));
    }

    public function store()
    {

        request()->validate([
            'role' => ['required', 'exists:roles,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:15', 'unique:users,phone'],
            'date_of_birth' => ['required', 'date'],
            'password' => ['required', 'confirmed', 'min:8'],

        ]);


        $data = new User;
        $data->name = request('name');
        $data->email = request('email');
        $data->phone = request('phone');
        $data->date_of_birth = request('date_of_birth');
        $data->password = bcrypt(request('password'));
        $data->save();

        $data->addRole(request('role'));


        return response()->json(['success' => 'Successfully Created']);
    }

    public function edit($id)
    {
        $user = User::with('roles')->find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        $role = $user->roles;

        return response()->json([
            'role' => $role,
            'user' => $user
        ]);
    }



    public function update($id)
    {
        request()->validate([
            'role' => ['required', 'exists:roles,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'phone' => ['required', 'string', 'max:15', 'unique:users,phone,' . $id],
            'date_of_birth' => ['required', 'date'],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        $data = User::find($id);
        $data->name = request('name');
        $data->email = request('email');
        $data->phone = request('phone');
        $data->date_of_birth = request('date_of_birth');
        if (request('password')) {
            $data->password = bcrypt(request('password'));
        }
        $data->save();

        $data->syncRoles([request('role')]);

        return response()->json(['success' => 'Successfully Updated']);
    }

    public function toggleactive($id){
        $user = User::find($id);
        $user->active =!$user->active;
        $user->save();
        return response()->json(['success' => 'Successfully Toggled Active Status']);
    }
}
