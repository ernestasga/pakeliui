<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\User;
class ListingsController extends Controller
{
    public function index()
    {
        $listings = Listing::all();
        return view('pages.admin.listings', compact(
            [
                'listings',
            ]
        ));
    }
}
