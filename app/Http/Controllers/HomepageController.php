<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function home(Request $request)
    {
        return view('agency/homepage');
    }
}
