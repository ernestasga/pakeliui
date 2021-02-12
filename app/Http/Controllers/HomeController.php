<?php

namespace App\Http\Controllers;

use App\Models\HotlineMessage;
use App\Models\Listing;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        SEOTools::setTitle(__('seo.titles.home.dashboard'));
        SEOTools::setDescription(__('seo.descriptions.home.dashboard'));
        $user = Auth::user();
        $listings = Listing::where('user_id',Auth::id())->get();
        $messages = HotlineMessage::where('user_id', $user->id)->get();
        return view('pages.user.home', compact('user', 'messages', 'listings'));
    }

    public function profile(User $user){
        SEOTools::setTitle(__('seo.titles.home.profile'));
        SEOTools::setDescription(__('seo.descriptions.home.profile'));
        $this->authorize('update', $user);
        $title = __('page.my_profile');
        return view('pages.user.profile', compact(
            'title',
            'user',
        ));
    }

    public function updateProfile(Request $request, User $user){
        $this->authorize('update', $user);
        $input = $request->all();
        $request->validate(
            [
                'country' => 'required|integer',
                'name' => 'required|string|max:30',
                'city' => 'nullable|string|max:30',
                'phone' => 'nullable|string|max:30',
                'gender' => 'nullable|string|max:8',
                'about' => 'nullable|string|max:2000',
            ]
        );
        $result = $user->update(
            [
                'name' => $input['name'],
                'country_id' => $input['country'],
                'city' => $input['city'],
                'phone' => $input['phone'],
                'gender' => $input['gender'],
                'about' => $input['about'],
            ]
        );
        if($result){
            return redirect(route('home'));
        }
    }
    public function updateProfileImage(Request $request, User $user){
        $this->authorize('update', $user);
        $request->validate(
            [
                'image' => 'required',
            ]
        );
        $result = $user->addMedia($request->file('image'))->toMediaCollection('user-images');
        if($result){
            return redirect()->back();
        }
    }
    public function updateCoverImage(Request $request, User $user){
        $this->authorize('customize', $user);
        $this->authorize('update', $user);
        $request->validate(
            [
                'image' => 'required',
            ]
        );
        $result = $user->addMedia($request->file('image'))->toMediaCollection('user-cover-images');
        if($result){
            return redirect()->back();
        }
    }
    public function deleteUser(User $user)
    {
        try {
            $user->listing()->delete();
            $user->hotlineMessage()->delete();
            $user->subscription()->delete();
            $user->delete();
        } catch (\Throwable $th) {
            echo $th;
        }
        return redirect(route('index'));
    }
}
