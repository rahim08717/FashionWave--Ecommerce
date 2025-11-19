<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Show admin dashboard
    public function index()
    {
        return view('admin.dashboard'); // resources/views/admin/dashboard.blade.php
    }

}
