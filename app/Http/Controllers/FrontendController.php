<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    function index() {
        $user = Auth::user();
         return view('frontend.welcome')->with('user', $user);
    }
}
