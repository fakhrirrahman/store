<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Reviews extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'review',
        'created_by',
        'updated_by',
    ];

    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->select('id', 'name');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by')->select('id', 'name');
    }
}
