<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Hash;
use Str;
use Auth;
class SocialLoginController extends Controller
{
    public function facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function facebookRedirect()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        $avatar_url = $user->getAvatar();
        $user = User::firstOrCreate([
            'email' => $user->email,
        ], [
            'name' => $user->name,
            'password' => Hash::make(Str::random(16)),
        ]);
        $user->addMediaFromUrl($avatar_url)->toMediaCollection('user-images');
        Auth::login($user, true);
        return redirect(route('home'));
    }
    public function google()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googleRedirect()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $avatar_url = $user->getAvatar();
        $user = User::firstOrCreate([
            'email' => $user->email,
        ], [
            'name' => $user->name,
            'password' => Hash::make(Str::random(16)),
        ]);
        $user->addMediaFromUrl($avatar_url)->toMediaCollection('user-images');
        Auth::login($user, true);
        return redirect(route('home'));
    }
}
