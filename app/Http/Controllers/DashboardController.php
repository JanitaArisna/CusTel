<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
    // Mencegah caching halaman dashboard
        return response()->view('dashboard')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, proxy-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0')
            ->header('Surrogate-Control', 'no-store');
    }
}