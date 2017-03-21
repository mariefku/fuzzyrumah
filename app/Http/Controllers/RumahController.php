<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Rumah;
use App\Markerlokasi;

class RumahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function listRumah(Request $request)
    { 
        $q = $request->q;

        if (strlen($q) > 0) {
            $rumahs = Rumah::where('njop_rumah', 'LIKE', '%' . $q . '%')->get();
        } else {
            $rumahs = Rumah::get();
        }
        return view('rumah.list')->with('rumahs', $rumahs);
    }

    public function showRumah($id)
    {
        $markers = Markerlokasi::get();
        $rumah = Rumah::find($id);
        return view('rumah.show')->with('rumah', $rumah)->with('markers', $markers);
    }

    public function createFormRumah()
    {
         $markers = Markerlokasi::get();
        return view('rumah.create')->with('markers', $markers);
    }

    public function createRumah(Request $request)
    {
        $this->validate($request, [
            'njopRumah' => 'required|numeric|min:500000|max:5000000',
            'kondisiRumah' => 'required|numeric|min:50|max:100',
            'usiaRumah' => 'required|numeric|min:0',
            'njopTanah' => 'required|min:500000|max:5000000',
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
        $rumah->save();


        return redirect()->action('RumahController@listRumah');
    }

    public function updateFormRumah($id)
    {
        $rumah = Rumah::find($id);
        return view('rumah.update')->with('rumah', $rumah);
    }

    public function updateRumah(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required|unique:rumahs,code,' . $id,
            'name' => 'required',
            'current_price' => 'required|numeric|min:0',
            'projection_profit' => 'required|numeric|min:0|max:100'
        ]);

        $rumah = Rumah::find($id);
        $rumah->code = $request->code;
        $rumah->name = $request->name;
        $rumah->current_price = $request->current_price;
        $rumah->projection_profit = $request->projection_profit;
        $rumah->save();

        return redirect()->action('RumahController@showRumah', [$rumah->id]);
    }

    public function deleteRumah($id)
    {
        $rumah = Rumah::find($id);
        $rumah->delete();

        return redirect()->action('RumahController@listRumah');
    }
}
