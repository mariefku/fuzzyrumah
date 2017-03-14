<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Fuzzyset;

class FuzzysetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function listSet()
    {
        $fuzzysets = Fuzzyset::get();
        return view('fuzzyset.list')->with('fuzzysets', $fuzzysets);
    }

    public function showSet($id)
    {
        $fuzzyset = Fuzzyset::find($id);
        return view('fuzzyset.show')->with('fuzzyset', $fuzzyset);
    }

    public function updateForm($id)
    {
        $fuzzyset = Fuzzyset::find($id);
        return view('fuzzyset.update')->with('fuzzyset', $fuzzyset);
    }

    public function updateSet(Request $request, $id)
    {
        $fuzzyset = Fuzzyset::find($id);
        $fuzzyset->result_price = $request->result_price;
        $fuzzyset->save();

        return redirect()->action('FuzzysetController@showSet', [$fuzzyset->id]);
    }
}
