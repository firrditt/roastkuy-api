<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Services\V1\Account\AccountService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct(
        protected AccountService $accountService
    ){}

    public function index()
    {
        $result = $this->accountService->index();

        return response()->json([
            "message" => $result->message,
            "data" => $result->data
            ], $result->statusCode);
    }

    public function updateProfileData(ProfileRequest $request)
    {
        try {
            $result = $this->accountService->saveUpdateProfile($request);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => 'profile_data'
            ], 500);
        }

        return response()->json([
            'message' => $result->message
        ], $result->statusCode);
    }

    public function deactiveAccount(Request $request)
    {
        try {
            $result = $this->accountService->deactiveAccount($request);
        } catch (\Throwable $e) {
            throw $e;
        }

        return response()->json([
            'message' => $result->message
        ], $result->statusCode);
    }
}
