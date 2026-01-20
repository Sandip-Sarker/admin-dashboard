<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $data['title'] = 'Dashboard | Home';
        return view('backend.layouts.dashboard')->with($data);
    }
}
