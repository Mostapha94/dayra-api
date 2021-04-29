<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name', 'description', 'supplier_id', 'category_id', 'price', 'discount', 'units', 'image'
    ];

    public function supplier()
    {
      return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function category()
    {
      return $this->belongsTo(Category::class, 'category_id');
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
