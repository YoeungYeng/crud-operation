<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /** @use HasFactory<\Database\Factories\BrandFactory> */
    use HasFactory;

    protected $table = "brands";
    protected $fillable = [
        "name",
        "email",
        "phone",
        "logo"
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
