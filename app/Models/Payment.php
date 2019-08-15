<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];
    //
    public function Supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
