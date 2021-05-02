<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
      'title', 'description', 'price', 'discount','private', 'path', 'original_name', 'bought', 'artist_id', 'user_id'
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDiscountPercentageAttribute()
    {
        return number_format(($this->discount) / ($this->price / 100), 1);
    }

    public function getTotalPriceAttribute()
    {
        return number_format(($this->price - $this->discount) / 100, 2);
    }

}
