<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Models\Role;

class UsersController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        $roles = Role::all();

        return $dataTable->render('admin.users.index', compact('roles'));
    }
}
