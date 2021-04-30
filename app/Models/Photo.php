<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
      'title', 'description', 'price', 'discount','private', 'path'
    ];

    public function sells()
    {
        return $this->hasMany(Sell::class);
    }

    public function buys()
    {
        return $this->hasMany(Buy::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getDiscountPercentageAttribute()
    {
        return number_format(($this->discount) / ($this->price / 100));
    }

}
