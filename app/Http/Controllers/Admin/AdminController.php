<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotlineMessage;
use App\Models\Listing;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('pages.admin.index');
    }
    
    public function ads()
    {
        return view('pages.admin.ads');
    }


}
