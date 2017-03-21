<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use App\Http\Requests;
use App\Rumah;
use App\Markerlokasi;
use App\Petablok;

class GuestController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRumah($id)
    {
        $markers = Markerlokasi::get();
        $rumah = Rumah::find($id);
        return view('guest.show')->with('rumah', $rumah)->with('markers', $markers);
    }

    public function createFormRumah()
    {
        $markers = Markerlokasi::get();
        $polygons = Petablok::get();
        return view('guest.create')->with('markers', $markers)->with('polygons', $polygons);
    }

    public function createRumah(Request $request)
    {
        $this->validate($request, [
            'njopRumah' => 'required|numeric|min:0|max:5000000',
            'kondisiRumah' => 'required|numeric|min:0',
            'usiaRumah' => 'required|numeric|min:0',
            'njopTanah' => 'required|numeric|min:0',
            'luasRumah' => 'required|numeric|min:0',
            'luasTanah' => 'required|numeric|min:0',

        ]);
        
        $rumah = new Rumah();
        $rumah->njop_rumah = $request->njopRumah;
        $rumah->kondisi_rumah = $request->kondisiRumah;
        $rumah->usia_rumah = $request->usiaRumah;
        $rumah->njop_tanah = $request->njopTanah;
        $rumah->luas_rumah = $request->luasRumah;
        $rumah->lokasi_tanah = $request->lokasiTanah;
        $rumah->nama_lokasi = json_encode($request->namaLokasi, JSON_PRETTY_PRINT);
        $rumah->luas_tanah = $request->luasTanah;
        $rumah->lat = $request->lat;
        $rumah->lng = $request->lng;
        $rumah->save();


        return redirect()->action('GuestController@showRumah', [$rumah->id]);
    }

}
