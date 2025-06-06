<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = "products";
    protected $fillable = [
        "name",
        "cost",
        "price",
        "category_id",
        "brand_id",
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function ca() {
        return $this->belongsTo(Ca::class);
    }
}
