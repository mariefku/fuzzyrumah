<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Fuzzy2range;

class Fuzzy2rangeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function listRange()
    {
        $fuzzyranges = Fuzzy2range::get();
        return view('fuzzy2range.list')->with('fuzzyranges', $fuzzyranges);
    }

    public function showRange($id)
    {
        $range = Fuzzy2range::find($id);
        return view('fuzzy2range.show')->with('fuzzyrange', $range);
    }

    public function updateForm($id)
    {
        $range = Fuzzy2range::find($id);
        return view('fuzzy2range.update')->with('fuzzyrange', $range);
    }

    public function updateRange(Request $request, $id)
    {
        $this->validate($request, [
            'min' => 'required|numeric',
            'max' => 'required|numeric'
        ]);

        $range = Fuzzy2range::find($id);
        $range->min = $request->min;
        $range->max = $request->max;
        $range->save();

        return redirect()->action('Fuzzy2rangeController@showRange', [$range->id]);
    }
}
