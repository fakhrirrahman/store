<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oders extends Model
{
    use HasFactory, HasUlids;

    const STATUS = [
        'PENDING' => 'PENDING',
        'PROCESSING' => 'PROCESSING',
        'COMPLETED' => 'COMPLETED',
        'CANCELLED' => 'CANCELLED',
    ];

    protected $fillable = [
        'product_id',
        'name',
        'total',
        'status',
        'created_by',
        'updated_by',
    ];

    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->select('id', 'name');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by')->select('id', 'name');
    }

    public function price()
    {
        return $this->product->price;
    }
}
