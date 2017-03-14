<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TesController extends Controller
{
        public function list()
    { 

        return view('rumah.test');
    }
}
