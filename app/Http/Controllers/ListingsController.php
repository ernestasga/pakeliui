<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ListingsController extends Controller
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
    public function index(Request $request)
    {
        SEOTools::setTitle(__('seo.titles.listings'));
        SEOTools::setDescription(__('seo.descriptions.listings'));
        $allowed_filters = [
            'from',
            'to',
            'type',
            AllowedFilter::scope('departure_from'),
            AllowedFilter::scope('departure_to'),
        ];
        $listings = QueryBuilder::for(Listing::class)
                    ->allowedFilters($allowed_filters)
                    ->latest()
                    ->paginate(config('variables.pagination_default_count'));

        return view('pages.listings', compact(
            'listings',
        ));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        SEOTools::setTitle(__('seo.titles.create'));
        SEOTools::setDescription(__('seo.descriptions.create'));
        return view('pages.create_listing');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $this->authorize('create', Listing::class);
        $country_id = $request->input('country');
        $from = $request->input(('from'));
        $to = $request->input(('to'));
        $departure = $request->input(('departure'));
        $seats = $request->input(('seats'));
        $type = $request->input(('type'));
        $price = $request->input(('price'));
        $phone = $request->input(('phone'));
        $note = $request->input(('note'));
        $vip = $request->input(('vip'));
        $image = $request->file('image');
        $can_customize = $user->can('customize', Listing::class);
        if(!$can_customize){
            $vip = '';
        }
        $request->validate(
            [
                'country' => 'required|integer',
                'from' => 'required|string|max:30',
                'to' => 'required|string|max:30',
                'departure' => 'required|date|max:255',
                'seats' => 'nullable|integer|min:1|max:9',
                'type' => 'required|string|max:20',
                'price' => 'nullable|numeric|min:0|max:999',
                'phone' => 'required|string|max:30',
                'note' => 'nullable|string|max:2000',
                'vip' => 'nullable|string|max:25',
                'image' => 'nullable',
            ]
        );
        $listing = Listing::create(
            [
                'user_id' => Auth::id(),
                'country_id' => $country_id,
                'from' => $from,
                'to' => $to,
                'departure' => $departure,
                'seats' => $seats,
                'type' => $type,
                'price' => $price,
                'phone' => $phone,
                'note' => $note,
                'vip' => $vip,
            ]
        );
        if($listing) {
            if($can_customize && isset($image)){
                $listing->addMedia($image)->toMediaCollection('uploaded-images');
            }
            return redirect()->route('listing.show', $listing->slug);
        }else{
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {

        SEOTools::setTitle(__('seo.titles.listing',[
            'from'=>$listing->from,
            'to'=>$listing->to
            ]));
        if($listing->type=='driver'){
            SEOTools::setDescription(__('seo.descriptions.listing_driver',[
                'count'=>$listing->seats,
                'from'=>$listing->from,
                'to'=>$listing->to,
                'date'=>$listing->departure->formatLocalized(config('app.datetime_format')),
            ]));
        }else{
            SEOTools::setDescription(__('seo.descriptions.listing_passenger',[
                'count'=>$listing->seats,
                'from'=>$listing->from,
                'to'=>$listing->to,
                'date'=>$listing->departure->formatLocalized(config('app.datetime_format')),
            ]));
        }
        return view('pages.listing', compact(
            'listing',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listing $listing)
    {
        $this->authorize('update', $listing);
        $user = Auth::user();
        $from = $request->input(('from'));
        $to = $request->input(('to'));
        $departure = $request->input(('departure'));
        $seats = $request->input(('seats'));
        $price = $request->input(('price'));
        $phone = $request->input(('phone'));
        $note = $request->input(('note'));
        $vip = $request->input(('vip'));
        $image = $request->file('image');
        $can_customize = $user->can('customize', Listing::class);
        if(!$can_customize){
            $vip = '';
        }
        $request->validate(
            [
                'from' => 'required|string|max:30',
                'to' => 'required|string|max:30',
                'departure' => 'required|date|max:255',
                'seats' => 'nullable|integer|min:1|max:9',
                'price' => 'nullable|numeric|min:0|max:999',
                'phone' => 'nullable|string|max:30',
                'note' => 'nullable|string|max:2000',
                'vip' => 'nullable|string|max:25',
                'image' => 'nullable',
            ]
        );

        $listing->update(
            [
                'from' => $from,
                'to' => $to,
                'departure' => $departure,
                'seats' => $seats,
                'price' => $price,
                'phone' => $phone,
                'note' => $note,
                'vip' => $vip,
            ]
        );
        if($listing) {
            if($can_customize && isset($image)){
                $listing->addMedia($image)->toMediaCollection('uploaded-images');
            }
            return redirect()->route('listing.show', $listing->slug);
        }else{
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        $this->authorize('delete', $listing);
        $result = $listing->delete();
        if($result){
            return redirect()->route('listing.index');
        }
    }

}
