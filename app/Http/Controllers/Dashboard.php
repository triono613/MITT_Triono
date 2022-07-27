<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboard extends Controller
{
    function dashboard()
    {
        return view('Layouts/master');
    }



}
