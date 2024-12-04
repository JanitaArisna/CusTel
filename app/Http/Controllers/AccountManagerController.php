<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountManagerController extends Controller
{
    public function index()
    {
        return view('account-manager.account-manager'); // Sesuaikan dengan nama view yang Anda inginkan
    }
}