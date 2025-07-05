<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HubController extends Controller
{
    /**
     * Display the school management page.
     *
     * @return \Illuminate\View\View
     */
    public function schools()
    {
        return view('hub.schools');
    }

    /**
     * Display the meet management page.
     *
     * @return \Illuminate\View\View
     */
    public function meets()
    {
        return view('hub.meets');
    }
}