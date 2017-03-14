<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
  protected $dates = [
    'created_at',
    'updated_at',
    'price_at'
  ];

  public function item()
  {
    return $this->belongsTo('App\Item', 'item_id');
  }

  public function getTypeStringAttribute()
  {
    switch ($this->type) {
    case "SBL":
      return "Harga Sebelum";
    case "KOM":
      return "Harga Kompetitor";
    default:
      return $this->type;
    }
  }
}
