<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    public function privacy()
    {
        if(app()->getLocale() == 'en'){
            return view('pages.legal.en.privacy_policy');
        }elseif(app()->getLocale() == 'lt'){
            return view('pages.legal.lt.privacy_policy');
        }
    }
    public function terms()
    {
        if(app()->getLocale() == 'en'){
            return view('pages.legal.en.terms');
        }elseif(app()->getLocale() == 'lt'){
            return view('pages.legal.lt.terms');
        }
    }
    public function sitemap()
    {
        return redirect(config('app.url').'/sitemap.xml');
    }
}
