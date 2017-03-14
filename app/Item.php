<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Fuzzy;
use App\Price;

class Item extends Model
{
    public function calculateFuzzy()
    {
        $fuzzy = new Fuzzy($this);
        return $fuzzy->calculate();
    }

    public function calculateFuzzy2()
    {
        $fuzzy = new Fuzzy2($this);
        return $fuzzy->calculate();
    }

    public function prices()
    {
        return $this->hasMany('App\Price', 'item_id');
    }

    public function save(array $options = Array())
    {
        $this->before_price = Price::where('item_id', '=', $this->id)
            ->where('type', '=', 'SBL')->avg('price');

        if ($this->before_price == null)
            $this->before_price = 0;

        $this->competitor_price = Price::where('item_id', '=', $this->id)
            ->where('type', '=', 'KOM')->avg('price');

        if ($this->competitor_price == null)
            $this->competitor_price = 0;

        $fuzzy = $this->calculateFuzzy();
        $this->fuzzy_price = $fuzzy->result;
        $this->fuzzy_calculation = json_encode($fuzzy, JSON_PRETTY_PRINT);

        $fuzzy2 = $this->calculateFuzzy2();
        $this->fuzzy2_price = $fuzzy2->result;
        $this->fuzzy2_calculation = json_encode($fuzzy2, JSON_PRETTY_PRINT);

        return parent::save($options);
    }

    public function delete()
    {
        $this->prices()->delete();
        return parent::delete();
    }
}
