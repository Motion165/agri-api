<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    /** @use HasFactory<\Database\Factories\FarmerFactory> */
    use HasFactory;

    public function transactions(){
        return $this->hasMany(Transactions::class);
    }
}
