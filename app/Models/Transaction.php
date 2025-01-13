<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'farmer_id',
        'amount',
        'type',
        'status',
        'description'
    ];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }
}