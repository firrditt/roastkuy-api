<?php

namespace App\Repositories\V1\Promo;

use App\Models\Promo;

class PromoRepository
{
    public function getAllPromo()
    {
        return Promo::latest()->get();
    }

    public function getRegularPromo()
    {
        return Promo::select()->where('type', 'regular')->get();
    }

    // public function getPromoAccount(string $id)
    // {
    //     return Promo::select()->where('account_id', $id)->get();
    // }
}
