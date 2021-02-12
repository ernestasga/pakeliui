<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        $subscriptions = Subscription::all();
        return view('pages.admin.subscriptions', compact('subscriptions', 'users', 'roles'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'user' => ['required', 'integer', 'min:1'],
            'role' => ['required', 'integer', 'min:1', 'max:5'],
            'expires' => ['required', 'date'],
        ]);
        $result = Subscription::create([
            'user_id' => $request['user'],
            'role_id' => $request['role'],
            'expires_at' => $request['expires'],
        ]);
        if($result){
            $result->user->giveRole($result->role->id);
        }
        return redirect()->back();
    }

    public function update(Request $request, Subscription $subscription)
    {
        $request->validate([
            'expires' => ['required', 'date'],
        ]);
        $subscription->update([
            'expires_at' => $request['expires'],
        ]);
        return redirect()->back();

    }
    public function destroy(Subscription $subscription)
    {
        $subscription->user->removeRoles();
        $subscription->delete();
        return redirect()->back();
    }
}
