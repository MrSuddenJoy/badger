<?php

namespace Coyote\Http\Controllers\Api;

use \Coyote\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return view('swagger');
    }
}
