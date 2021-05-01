<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FinancialController extends Controller
{
    private const BUY = 0;
    private const SELL = 1;

    public function manageFinancialTransactions(Photo $photo)
    {
        $buyer = auth()->user();

        $photoTotalPrice = $photo->price - $photo->discount;

        if(!($photoTotalPrice<= $buyer->balance)) {
            return redirect()->back()->withErrors("Insuficient Balance!");
        }
        $this->makeFinancialTransaction($photo);

        return redirect()->route('dashboard');

    }

    public function makeTransaction($type, User $user, $otherUserId, $photoId, $photoPrice, $photoDiscount)
    {
        $totalPrice = $photoPrice - $photoDiscount;

        switch($type) {
            case self::BUY:
                $user->purchases()->create([
                    'seller_id' => $otherUserId,
                    'photo_id' => $photoId,
                    'price' => $photoPrice,
                    'discount' => $photoDiscount,
                    'total' =>  $totalPrice,
                ]);
                break;
            case self::SELL:
                $user->sales()->create([
                    'buyer_id' => $otherUserId,
                    'photo_id' => $photoId,
                    'price' => $photoPrice,
                    'discount' => $photoDiscount,
                    'total' => $totalPrice,
                ]);
                break;
        }
    }


    private function copyPhotoAndGetPath(string $originaPhotoPath, string $originalPhotoName)
    {
        $photoController = new PhotoController();
        $path = 'photos/' . auth()->id() . '/' . Str::random(40) .  $originalPhotoName;

        if(!Storage::disk('public')->copy($this->getPhotoPath($originaPhotoPath), $path)) {
            return redirect()->back()->withErrors("Internal Server Error. Try again later!");
        }

        return 'storage/' . $path;
    }

    private function processBalance(int $photoTotalPrice, User $buyer, User $seller)
    {
        $buyer->update([
            'balance' => $buyer->balance - $photoTotalPrice
        ]);

        $seller->update([
            'balance' => $seller->balance + $photoTotalPrice
        ]);
    }

    private function makeFinancialTransaction($photo)
    {

        $buyer = auth()->user();
        $seller = $photo->user;

        $path = $this->copyPhotoAndGetPath($photo->path, $photo->original_name);

        $photoTotalPrice = $photo->price - $photo->discount;

        $boughtPhoto = $buyer->photos()->create([
            'title' => $photo->title,
            'description' => $photo->description,
            'price' => $photo->price,
            'discount' => $photo->discount,
            'artist_id' => $seller->id,
            'private' => 1,
            'bought' => 1,
            'path' => $path,
            'original_name' => $photo->original_name
        ]);

        $this->makeTransaction(self::BUY, $buyer, $seller->id, $boughtPhoto->id, $photo->price, $photo->discount);
        $this->makeTransaction(self::SELL, $seller, $buyer->id, $photo->id, $photo->price, $photo->discount);

        $this->processBalance($photoTotalPrice, $buyer, $seller);
    }

    private function getPhotoPath(string $rawPath)
    {
        return explode('storage/', $rawPath)[1];
    }
}
