<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Role extends Model
{
    use HasFactory, HasUlids;

    const NAME = [
        'ADMIN' => 'ADMIN',
        'USER' => 'USER',
    ];

    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
