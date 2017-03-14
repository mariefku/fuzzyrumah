<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use App\Http\Requests;
use App\Markerlokasi;

class MapController extends Controller
{
    public function index()
	{

        $markers = Markerlokasi::get();

        return view('maps.show')->with('markers', $markers);

	}

    public function add()
	{
	    return view('maps.create');
	}

	public function save(Request $request)
	{
        $this->validate($request, [
            'nama_lokasi' => 'required',
            'kategori_lokasi' => 'required',
        ]);
        
        $rumah = new Markerlokasi();
        $rumah->nama_lokasi = $request->nama_lokasi;
        $rumah->lat = $request->lat;
        $rumah->lng = $request->lng;
        $rumah->kategori_lokasi = $request->kategori_lokasi;
        $rumah->save();


        return redirect()->action('MapController@add');
	}

}
