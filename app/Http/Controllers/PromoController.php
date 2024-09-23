<?php

namespace App\Http\Controllers;

use App\Services\V1\Promo\PromoService;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function __construct(
        protected PromoService $promoService
    ){}

    public function getAllPromos()
    {
        $result = $this->promoService->doGetAllPromo();

        return response()->json([
            "message" => $result->message,
            "data" => $result->data
        ], $result->statusCode);
    }

    public function getRegularPromos()
    {
        $result = $this->promoService->doGetRegularPromo();

        return response()->json([
            "message" => $result->message,
            "data" => $result->data
        ], $result->statusCode);
    }

    // public function getPromosOnAccount()
    // {
    //     $result = $this->promoService->doGetAccountPromo();

    //     return response()->json([
    //         "message" => $result->message,
    //         "data" => $result->data
    //     ], $result->statusCode);
    // }
}
