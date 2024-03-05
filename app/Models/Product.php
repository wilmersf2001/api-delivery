<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected  $table = 'tb_product';

    protected $fillable =
    [
        'name',
        'description',
        'price',
        'establishment_id'
    ];

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }
}
