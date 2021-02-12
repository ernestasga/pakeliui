<?php

namespace App\Http\Controllers;

use App\Models\HotlineMessage;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotlineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEOTools::setTitle(__('seo.titles.hotline'));
        SEOTools::setDescription(__('seo.descriptions.hotline'));
        $messages = HotlineMessage::latest()->paginate(config('variables.hotline_pagination_default_count'));
        $nav_clear = true;
        return view('pages.hotline', compact(
            'nav_clear',
            'messages',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', HotlineMessage::class);
        $user = Auth::user();
        $message = $request->input('message');
        $vip = $request->input(('vip'));
        if(!$user->can('customize', Listing::class)){
            $vip = '';
        }
        $request->validate([
            'message' => 'required|string|max:2000',
            'vip'=> 'nullable|string|max:30',
        ]);
        $result = HotlineMessage::create(
            [
                'user_id' => $user->id,
                'message' => $message,
                'vip' => $vip,
            ]
        );
        if($result){
            return redirect()->back();
        }
    }



    public function update(Request $request, HotlineMessage $hotline)
    {
        $this->authorize('update', $hotline);
        $user = Auth::user();
        $vip = $request->input(('vip'));
        if(!$user->can('customize', Listing::class)){
            $vip = '';
        }
        $request->validate([
            'message' => 'required|string|max:2000',
            'vip' => 'nullable|string|max:30'
        ]);
        $hotline->update([
            'message' => $request->input('message'),
            'vip' => $vip,
        ]);
        return redirect()->back();
    }
    public function destroy(HotlineMessage $hotline)
    {
        $this->authorize('delete', $hotline);
        $result = $hotline->delete();
        if($result){
            return redirect()->back();
        }
    }

}
