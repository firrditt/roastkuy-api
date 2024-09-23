<?php

namespace App\Services\V1\Outlet;

use App\Http\Resources\OutletDetailResource;
use App\Http\Resources\OutletResource;
use App\Repositories\V1\Outlet\OutletRepository;
use Illuminate\Http\Response;

class OutletService
{
   public function __construct(
    protected OutletRepository $outletRepository
   ){}

   public function doGetAlldata()
   {
        $data = $this->outletRepository->getAllOutlet();

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
            "data" => OutletResource::collection($data)
        ];
   }

   public function doGetDataBySlug(string $slug)
   {
        $data = $this->outletRepository->findOutletBySlug(slug: $slug);

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
            "data" => new OutletDetailResource($data)
        ];
   }
}
