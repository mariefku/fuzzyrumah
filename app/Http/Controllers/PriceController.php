<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Price;
use App\Item;
use Carbon\Carbon;

class PriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function listPrice(Request $request)
    { 
        $q = $request->q;

        $prices = Price::orderBy('price_at', 'DESC');

        if (strlen($q) > 0) {
            $items = Item::where('name', 'LIKE', '%' . $q . '%')
                ->orWhere('code', 'LIKE', '%' . $q . '%')->lists('id');
            $prices = $prices->whereIn('item_id', $items);                
        }

        $prices = $prices->get();

        return view('price.list')->with('prices', $prices);
    }

    public function showPrice($id)
    {
        $price = Price::find($id);
        return view('price.show')->with('price', $price);
    }

    public function createForm()
    {
        $items = Item::all();

        return view('price.create')
          ->with('items', $items);
    }

    public function createPrice(Request $request)
    {
        $this->validate($request, [
            'item_id' => 'required|numeric',
            'price' => 'required|numeric',
            'price_at' => 'required',
            'type' => 'required',
        ]);

        $price = new Price();
        $price->item_id = $request->item_id;
        $price->price = $request->price;
        $price->price_at = Carbon::createFromFormat("d/m/Y", $request->price_at);
        $price->type = $request->type;
        $price->save();

        $price->item->save();

        return redirect()->action('PriceController@showPrice', [$price->id]);
    }

    public function updateForm($id)
    {
        $price = Price::find($id);
        $items = Item::all();

        return view('price.update')
          ->with('price', $price)
          ->with('items', $items);
    }

    public function updatePrice(Request $request, $id)
    {
        $this->validate($request, [
            'item_id' => 'required|numeric',
            'price' => 'required|numeric',
            'price_at' => 'required',
            'type' => 'required',
        ]);

        $price = Price::find($id);
        $price->item_id = $request->item_id;
        $price->price = $request->price;
        $price->price_at = Carbon::createFromFormat("d/m/Y", $request->price_at);
        $price->type = $request->type;
        $price->save();

        $price->item->save();

        return redirect()->action('PriceController@showPrice', [$price->id]);
    }

    public function deletePrice($id)
    {
        $price = Price::find($id);
        $price->delete();

        $price->item->save();

        return redirect()->action('PriceController@listPrice');
    }
}
