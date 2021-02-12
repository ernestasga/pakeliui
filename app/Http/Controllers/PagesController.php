<?php

namespace App\Http\Controllers;

use App\Models\HotlineMessage;
use App\Models\Listing;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOTools;

class PagesController extends Controller
{
    public function index(){
        SEOTools::setTitle(__('seo.titles.index'));
        SEOTools::setDescription(__('seo.descriptions.default'));
        $listings = Listing::latest()->take(5)->get();
        return view('pages.index', compact(
            'listings',
        ));
    }

    public function profile(User $user){
        SEOTools::setTitle(__('seo.titles.profile', ['name'=>$user->name]));
        SEOTools::setDescription(__('seo.descriptions.profile',
            ['name'=>$user->name,
            'country'=>__('countries.'.$user->country->code)]));
        $listings = Listing::where('user_id', $user->id)->latest()->paginate(config('variables.pagination_default_count'));
        $messages = HotlineMessage::where('user_id', $user->id)->latest()->paginate(config('variables.pagination_default_count'));
        $title = $user->name;
        $subtitle = $user->about;
        return view('pages.profile', compact(
            'user',
            'title',
            'subtitle',
            'listings',
            'messages',
        ));
    }
    public function getVip()
    {
        return view('pages.get_vip');
    }

}
