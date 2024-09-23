<?php

namespace App\Http\Controllers;

use App\Http\Resources\OutletResource;
use App\Services\V1\Outlet\OutletService;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function __construct(
        protected OutletService $outletService
    ){}

    public function getAll(){
        $result = $this->outletService->doGetAlldata();

        return response()->json([
            "message" => $result->message,
            "data" => $result->data
        ], $result->statusCode);
    }

    public function getBySlug(string $slug)
    {
        $result = $this->outletService->doGetDataBySlug(slug: $slug);

        return response()->json([
            "message" => $result->message,
            "data" => $result->data
        ], $result->statusCode);
    }
}
