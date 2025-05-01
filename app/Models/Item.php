<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Item extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'name',
        'processor',
        'ram',
        'storage',
        'gpu',
        'price',
        'condition',
        'description',
        'image',
        'isSold',
        'keyword'
    ];


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
