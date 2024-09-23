<?php

namespace App\Services\V1\Promo;

use App\Http\Resources\PromoResource;
use App\Repositories\V1\Promo\PromoRepository;
use Illuminate\Http\Response;

class PromoService {
    public function __construct(
        protected PromoRepository $promoRepository
    ){}


    public function doGetAllPromo()
    {
        $data = $this->promoRepository->getAllPromo();

        if (empty($data)) {
            return (object) [
                "statusCode" => Response::HTTP_BAD_REQUEST,
                "message" => "Data tidak ditemukan!",
                "data" => []
            ];
        }

        return (object) [
            "statusCode" => Response::HTTP_OK,
            "message" => "Data ditemukan!",
            "data" => PromoResource::collection($data)
        ];
    }

    public function doGetRegularPromo()
    {
        $data = $this->promoRepository->getRegularPromo();

        if (empty($data)) {
            return (object) [
                "statusCode" => Response::HTTP_BAD_REQUEST,
                "message" => "Data tidak ditemukan!",
                "data" => []
            ];
        }

        return (object) [
            "statusCode" => Response::HTTP_OK,
            "message" => "Data ditemukan!",
            "data" => PromoResource::collection($data)
        ];
    }

    // public function doGetAccountPromo()
    // {
    //     $id = auth()->user()->id;
    //     $data = $this->promoRepository->getPromoAccount(id: $id);

    //     if (empty($data)) {
    //         return (object) [
    //             "statusCode" => Response::HTTP_BAD_REQUEST,
    //             "message" => "Data tidak ditemukan!",
    //             "data" => []
    //         ];
    //     }

    //     return (object) [
    //         "statusCode" => Response::HTTP_OK,
    //         "message" => "Data ditemukan!",
    //         "data" => $data
    //     ];
    // }
}
