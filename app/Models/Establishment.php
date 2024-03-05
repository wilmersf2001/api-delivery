<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory;

    protected $table = 'tb_establishments';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'logo',
        'category',
        'stars',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
