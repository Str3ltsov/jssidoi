<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $users = User::paginate(20);
        return view('jssi.admin.users.index')->with('users', $users);
    }

    public function edit($userId)
    {
        $user = User::find($userId);
        $roles = Role::all()->pluck('name')->all();
        if (auth()->user()->hasRole('Super Admin')) {
            return view("jssi.admin.users.edit")->with(['user' => $user, 'roles' => $roles]);
        }
        $roles = array_diff($roles, ['Super Admin']);
        return view('jssi.admin.users.edit')->with(['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, $userId)
    {

        $user = User::find($userId);

        $user->syncRoles($request->input('role'));
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('admin.users.index')->with('success', `User {$user->email} updated sucessfuly`);
    }
}
