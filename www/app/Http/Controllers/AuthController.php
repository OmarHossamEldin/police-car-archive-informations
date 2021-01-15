<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    /**
     * the main home page which is login Page for the app
     * @return view of the home page
     */
    public function home(){
        return Inertia::render('Auth/index');
    }
}
