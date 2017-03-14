<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Fuzzy2set;

class Fuzzy2setController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listSet()
    {
        $fuzzysets = Fuzzy2set::get();
        return view('fuzzy2set.list')->with('fuzzysets', $fuzzysets);
    }

    public function showSet($id)
    {
        $fuzzyset = Fuzzy2set::find($id);
        return view('fuzzy2set.show')->with('fuzzyset', $fuzzyset);
    }

    public function updateForm($id)
    {
        $fuzzyset = Fuzzy2set::find($id);
        return view('fuzzy2set.update')->with('fuzzyset', $fuzzyset);
    }

    public function updateSet(Request $request, $id)
    {
        $fuzzyset = Fuzzy2set::find($id);
        $fuzzyset->result_price = $request->result_price;
        $fuzzyset->save();

        return redirect()->action('Fuzzy2setController@showSet', [$fuzzyset->id]);
    }
}
