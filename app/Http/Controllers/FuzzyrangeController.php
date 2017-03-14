<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Fuzzyrange;

class FuzzyrangeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function listRange()
    {
        $fuzzyranges = Fuzzyrange::get();
        return view('fuzzyrange.list')->with('fuzzyranges', $fuzzyranges);
    }

    public function showRange($id)
    {
        $range = Fuzzyrange::find($id);
        return view('fuzzyrange.show')->with('fuzzyrange', $range);
    }

    public function updateForm($id)
    {
        $range = Fuzzyrange::find($id);
        return view('fuzzyrange.update')->with('fuzzyrange', $range);
    }

    public function updateRange(Request $request, $id)
    {
        $this->validate($request, [
            'min' => 'required|numeric',
            'max' => 'required|numeric'
        ]);

        $range = Fuzzyrange::find($id);
        $range->min = $request->min;
        $range->max = $request->max;
        $range->save();

        return redirect()->action('FuzzyrangeController@showRange', [$range->id]);
    }
}
