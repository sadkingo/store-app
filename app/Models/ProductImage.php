<?php

namespace App\Models;

use App\Traits\PositionTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
    {
    use HasFactory,PositionTrait;
    protected $fillable =[
        'product_id',
        'image_url',
        'position',
    ];
    public function product()
        {
        return $this->belongsTo(Product::class);
        }
    }
