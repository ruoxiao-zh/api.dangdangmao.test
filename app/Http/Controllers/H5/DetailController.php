<?php

namespace App\Http\Controllers\H5;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    public function index()
    {
        return view('h5.detail');
    }
}
