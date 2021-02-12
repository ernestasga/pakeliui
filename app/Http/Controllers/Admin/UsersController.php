<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.admin.users', compact(
            [
                'users',
            ]
        ));
    }
    public function updateUserRole(Request $request, User $user){
        $request->validate(['role' => 'required|integer|min:1|max:5']);
        $user->update(['role_id' => $request['role']]);
        return redirect()->back();
    }

}
