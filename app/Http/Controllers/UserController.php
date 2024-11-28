<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index')->with('users', User::getAllUsers());
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
}
