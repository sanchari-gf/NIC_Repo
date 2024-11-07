<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    // Define guarded attributes
    protected $guarded = ['id']; // Protect the 'id' field from mass assignment

    // An expenditure belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // An expenditure belongs to an item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}


