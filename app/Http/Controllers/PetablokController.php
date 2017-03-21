<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Petablok;

class petablokController extends Controller
{
    public function index()
	{

        $polygons = Petablok::find(19);

        return view('polygons.show')->with('polygons', $polygons);

	}

    public function show()
	{

        $polygons = Petablok::get();

        return view('polygon.show')->with('polygons', $polygons);

	}

    public function add()
	{


	    return view('polygon.create');
	}

    public function add2()
	{


	    return view('polygon.create');
	}

	public function save(Request $request)
	{
        $this->validate($request, [
            'nama_area' => 'required',
            'area_lokasi' => 'required',
            'harga_area' => 'required',
        ]);
        
        $rumah = new Petablok();
        $rumah->nama_area = $request->nama_area;
        $rumah->area_lokasi = $request->area_lokasi;
        $rumah->harga_area = $request->harga_area;
        $rumah->save();


        return redirect()->action('PetablokController@add');
	}
}
