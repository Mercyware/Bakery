<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    //
    protected $guarded = [];

    protected $dates = ['date_delivered'];

    public function Supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
