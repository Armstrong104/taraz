<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'price',
        'desc',
        'image'
    ];

    // public static $product;
    // public static function storeProduct($r){
    //     self::$product = new Product;
    //     self::$product->name = $r->name;
    //     self::$product->price = $r->price;
    //     self::$product->desc = $r->desc;
    //     self::$product->image = imageUpload($r->image,'product-images');
    //     self::$product->category_id = $r->category_id;
    //     self::$product->save();

    // }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
