<?php

// app/Models/Item.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'item_group_id'];

    public function itemGroup()
    {
        return $this->belongsTo(ItemGroup::class);
    }

    // app/Models/Item.php

public function expenditures()
{
    return $this->hasMany(Expenditure::class);
}



}





