<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPurchaser extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'purchaser_id',
        'product_id',
        'purchase_timestamp',
    ];

    public function setPurchaseTimestampAttribute($value)
    {
        $this->attributes['purchase_timestamp'] = gmdate('Y-m-d H:i:s', $value);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
