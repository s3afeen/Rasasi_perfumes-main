<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded  = [];

    public function subCategory()
    {
         return $this->belongsTo(SubCategory::class);
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    } 

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

   
}
