<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Addresses extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'addresses';

    protected $fillable = [
        'user_id',
        'address',
        'city',
        'postal_code',
        'country',
        'created_by',
        'updated_by',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'user_id');
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
