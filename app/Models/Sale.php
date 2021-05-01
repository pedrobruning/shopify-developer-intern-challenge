<?php

namespace App\Models;

use App\Models\Core\FinancialModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends FinancialModel
{
    use HasFactory;

    protected $fillable = [
        'buyer_id', 'photo_id', 'price', 'total', 'discount'
    ];

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id','id');
    }
}
