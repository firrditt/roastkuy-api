<?php

namespace App\Services\V1\Menu;

use App\Http\Resources\MenuDetailResource;
use App\Http\Resources\MenuResource;
use App\Repositories\V1\Menu\MenuComplementRepository;
use App\Repositories\V1\Menu\MenuRepository;
use Illuminate\Http\Response;

class MenuService
{
    public function __construct(
        protected MenuRepository $menuRepository,
    ){}

    public function doGetDataByOutlet(int $outlet_id)
    {
        $data = $this->menuRepository->findMenuByOutlet(outlet_id: $outlet_id);

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
            "data" => $data
        ];
    }

    public function doGetDataById(string $id)
    {
        $data = $this->menuRepository->findMenuById(id: $id);

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
            "data" => MenuResource::collection($data)
        ];
    }

    public function doGetMenuDetail(string $id)
    {
        $data = $this->menuRepository->findDetailById(id: $id);

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
            "data" => new MenuResource($data),
        ];
    }
}
