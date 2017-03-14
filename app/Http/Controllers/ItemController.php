<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Item;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function listItem(Request $request)
    { 
        $q = $request->q;

        if (strlen($q) > 0) {
            $items = Item::where('name', 'LIKE', '%' . $q . '%')->orWhere('code', 'LIKE', '%' . $q . '%')->get();
        } else {
            $items = Item::get();
        }
        return view('item.list')->with('items', $items);
    }

    public function showItem($id)
    {
        $item = Item::find($id);
        return view('item.show')->with('item', $item);
    }

    public function createForm()
    {
        return view('item.create');
    }

    public function createItem(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:items,code',
            'name' => 'required',
            'current_price' => 'required|numeric|min:0',
            'projection_profit' => 'required|numeric|min:0|max:100'
        ]);

        $item = new Item();
        $item->code = $request->code;
        $item->name = $request->name;
        $item->current_price = $request->current_price;
        $item->projection_profit = $request->projection_profit;
        $item->save();

        return redirect()->action('ItemController@showItem', [$item->id]);
    }

    public function updateForm($id)
    {
        $item = Item::find($id);
        return view('item.update')->with('item', $item);
    }

    public function updateItem(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required|unique:items,code,' . $id,
            'name' => 'required',
            'current_price' => 'required|numeric|min:0',
            'projection_profit' => 'required|numeric|min:0|max:100'
        ]);

        $item = Item::find($id);
        $item->code = $request->code;
        $item->name = $request->name;
        $item->current_price = $request->current_price;
        $item->projection_profit = $request->projection_profit;
        $item->save();

        return redirect()->action('ItemController@showItem', [$item->id]);
    }

    public function deleteItem($id)
    {
        $item = Item::find($id);
        $item->delete();

        return redirect()->action('ItemController@listItem');
    }
}
