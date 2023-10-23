<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    public function __construct() {

    }

    public function index() {
        $users = User::paginate(20);

        return view('jssi.admin.users.index')
    }
}
