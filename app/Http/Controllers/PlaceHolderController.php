<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Config;
use Illuminate\Support\Facades\Auth;
use DateTime;

class PlaceHolderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        if(isset($_COOKIE["company_id"]) && $_COOKIE["company_id"] != 0) {
            if(Auth::user()->company_id != 0 && Auth::user()->company_id != $_COOKIE["company_id"]) {
                return redirect()->route('logout');
            } else {
                Auth::user()->last_login = new DateTime();
                Auth::user()->save();
                return view('place_holder');
            }
        } else {
            if(Auth::user()->company_id != 0) {
                return redirect()->route('logout');
            }
        }

        return view('place_holder');
    }
}
