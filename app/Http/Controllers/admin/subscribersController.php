<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Illuminate\Http\Request;


class SubscribersController extends Controller
{
    public function subscribers()
    {
        $subscribers = Subscribe::latest()->get();
        return view('admin.subscribers', compact('subscribers'));
    }



}
