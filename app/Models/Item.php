<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory, SoftDeletes;
    
    // Add this line to explicitly enable timestamps
    public $timestamps = true;
    
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'quantity',
        'price',
        'unit',
        'location',
        'condition',
        'qr_code',
        'expiry_date',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}