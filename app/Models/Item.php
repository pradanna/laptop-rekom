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


    // app/Models/Item.php
    public static function searchContentBased($keyword)
    {
        $keywords = explode(' ', strtolower($keyword)); // Pecah kata-kata pencarian

        $items = self::where('isSold', false)->get();

        $scoredItems = $items->map(function ($item) use ($keywords) {
            // Gabungkan fitur laptop menjadi satu profil
            $profile = strtolower(
                $item->name . ' ' .
                    $item->type . ' ' .
                    $item->processor . ' ' .
                    $item->ram . ' ' .
                    $item->ssd . ' ' .
                    $item->hdd . ' ' .
                    $item->graphic . ' ' .
                    $item->keyword
            );

            // Hitung berapa banyak kata kunci user yang cocok
            $score = 0;
            foreach ($keywords as $word) {
                if (str_contains($profile, $word)) {
                    $score++;
                }
            }

            $item->score = $score; // Simpan skor
            return $item;
        });

        // Urutkan berdasarkan skor, dan filter skor > 0
        return $scoredItems->sortByDesc('score')->filter(function ($item) {
            return $item->score > 0;
        });
    }


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
