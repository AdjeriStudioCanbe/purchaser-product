<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function purchasers()
    {
        return $this->belongsToMany(Purchaser::class, 'product_purchasers');
    }

    public function product_purchasers()
    {
        return $this->hasMany(ProductPurchaser::class);
    }
}
