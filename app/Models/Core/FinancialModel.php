<?php

namespace App\Models\Core;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialModel extends Model
{
    use HasFactory;

    public function buyer()
    {
        return $this->belongsTo(User::class,'buyer_id','id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }


}
