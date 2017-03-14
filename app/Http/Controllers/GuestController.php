<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use App\Http\Requests;
use App\Rumah;

class GuestController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRumah($id)
    {
        $rumah = Rumah::find($id);
        return view('guest.show')->with('rumah', $rumah);
    }

    public function createFormRumah()
    {
        Mapper::map(-7.058083, 110.423867, [
            'zoom'      => 15,
            'markers'   => [
                            'title' => 'My Location', 'animation' => 'DROP'
                           ],
            'clusters'  => ['size' => 10, 'center' => true, 'zoom' => 20],
            'draggable' => true,
            ]);
        return view('guest.create');
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
        
        $hasilLokasi = count($request->lokasiTanah);

        $rumah = new Rumah();
        $rumah->njop_rumah = $request->njopRumah;
        $rumah->kondisi_rumah = $request->kondisiRumah;
        $rumah->usia_rumah = $request->usiaRumah;
        $rumah->njop_tanah = $request->njopTanah;
        $rumah->luas_rumah = $request->luasRumah;
        $rumah->lokasi_tanah = $hasilLokasi;
        $rumah->nama_lokasi = json_encode($request->lokasiTanah, JSON_PRETTY_PRINT);
        $rumah->luas_tanah = $request->luasTanah;
        $rumah->save();


        return redirect()->action('GuestController@showRumah', [$rumah->id]);
    }

}
