<?php

namespace App\Http\Controllers;

use App\Services\V1\Menu\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct(
        protected MenuService $menuService
    ){}

    public function getMenuByOutlet(string $outlet_id)
    {
       $result =  $this->menuService->doGetDataByOutlet(outlet_id: $outlet_id);

       return response()->json([
        "message" => $result->message,
        "data" => $result->data
        ], $result->statusCode);
    }

    public function getMenuById(string $id)
    {
        $result =  $this->menuService->doGetDataById(id: $id);

        return response()->json([
         "message" => $result->message,
         "data" => $result->data
         ], $result->statusCode);
    }

    public function getMenuDetail(string $id)
    {
        $result = $this->menuService->doGetMenuDetail(id: $id);

        return response()->json([
            "message" => $result->message,
            "data" => $result->data
            ], $result->statusCode);
    }
}
