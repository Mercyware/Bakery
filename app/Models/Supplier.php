<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $guarded = [];

    public function Supplies()
    {
        return $this->hasMany(Supply::class, 'supplier_id');
    }

    public function Payment()
    {
        return $this->hasMany(Payment::class, 'supplier_id');
    }
}
