<?php

namespace App\Http\Controllers;

use App\Exceptions\UnauthorizeException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Services\V1\AuthService;
use App\Services\V1\VerifyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService,
        protected VerifyService $verifyService
    ){}

    public function login(LoginRequest $request): JsonResponse | LoginResource
    {
        try {
            $result = $this->authService->doLogin(email: $request->email, password: $request->password);
        } catch (UnauthorizeException $e) {
            return response()->json([
                "code" => $e->getErrorCode(),
                "message" => $e->getMessage(),
            ], $e->getCode());
        }
        // dd($result);
        return (new LoginResource($result));
    }

    public function register(RegisterRequest $request): JsonResponse | LoginResource
    {
        try {
            $result = $this->authService->doRegister($request);
        } catch (UnauthorizeException $e) {
            return response()->json([
                "code" => $e->getErrorCode(),
                "message" => $e->getMessage(),
            ], $e->getCode());
        }

        // dd($result);

        return (new LoginResource($result));
    }

    public function logout(): JsonResponse
    {
        try {
            $result = $this->authService->doLogout();
        } catch (UnauthorizeException $e) {
            return response()->json([
                "code" => $e->getErrorCode(),
                "message" => $e->getMessage(),
            ], 500);
        }

        // dd($result);

        return response()->json([
            'message' => $result->message
        ], $result->statusCode);
    }

    // public function sendVerification($uuid)
    // {
    //     try {
    //         $result = $this->verifyService->verificationAccountSend($uuid);
    //     } catch (UnauthorizeException $e) {
    //         return response()->json([
    //             "code" => $e->getErrorCode(),
    //             "message" => $e->getMessage(),
    //         ], $e->getCode());
    //     }

    //     // dd($result);

    //     return response()->json([
    //         'message' => $result->message
    //     ], $result->statusCode);
    // }

    public function sendVerificationOTP()
    {
        try {
            $result = $this->verifyService->verificationAccountSend();
        } catch (UnauthorizeException $e) {
            return response()->json([
                "code" => $e->getErrorCode(),
                "message" => $e->getMessage(),
            ], $e->getCode());
        }

        // dd($result);

        return response()->json([
            'status' => $result->statusCode,
            'message' => $result->message
        ], $result->statusCode);
    }

    public function accountVerification(Request $request)
    {
        try {
            $result = $this->verifyService->verificationAccount($request);
        } catch (UnauthorizeException $e) {
            return response()->json([
                "code" => $e->getErrorCode(),
                "message" => $e->getMessage(),
            ], $e->getCode());
        }

        // dd($result);

        return response()->json([
            'status' => $result->statusCode,
            'message' => $result->message
        ], $result->statusCode);
    }

    // public function me(): JsonResponse
    // {
    //     try {
    //         $result = $this->authService->onLogin();
    //     } catch (UnauthorizeException $e) {
    //         return response()->json([
    //             "code" => $e->getErrorCode(),
    //             "message" => $e->getMessage(),
    //         ], 500);
    //     }

    //     return response()->json([
    //         'message' => $result->message,
    //         'data' => $result->data
    //     ], $result->statusCode);
    // }
}
