<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotlineMessage;
use Illuminate\Http\Request;

class HotlineController extends Controller
{
    public function index()
    {
        $messages = HotlineMessage::all();
        return view('pages.admin.hotline', compact(
            [
                'messages',
            ]
        ));
    }
}
