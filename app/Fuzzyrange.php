<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fuzzyrange extends Model
{
    public function getMiddleAttribute()
    {
        return ($this->max - $this->min) / 2 + $this->min;
    }
}
