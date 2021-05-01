<?php

namespace App\Models;

use App\Models\Core\FinancialModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends FinancialModel
{
    use HasFactory;

    protected $fillable = [
        'seller_id', 'photo_id', 'price', 'total', 'discount'
    ];
}
