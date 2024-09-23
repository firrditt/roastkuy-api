<?php

namespace App\Services\V1;

use App\Exceptions\UnauthorizeException;
use App\Http\Requests\RegisterRequest;
use App\Repositories\V1\AuthRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(
        private AuthRepository $authRepository
    ){}

    public function doLogin(
        string $email,
        string $password
    ):  object {
        $account = $this->authRepository->findAccountByEmail(email: $email);

        if(!$account){
            throw new UnauthorizeException(message: "Maaf, anda tidak terdaftar dalam sistem kami", code: Response::HTTP_UNAUTHORIZED);
        }

        if($account->status == 5){
            throw new UnauthorizeException(message: "Maaf, akun anda telah ditangguhkan", code: Response::HTTP_UNAUTHORIZED);
        }

        if (!Hash::check(value: $password, hashedValue: $account->password)) {
            throw new UnauthorizeException(message: "Kata sandi yang anda masukan salah", code: Response::HTTP_UNAUTHORIZED);
        }

        $token = $account->createToken($email)->plainTextToken;
        $account->last_login_at = now();
        $account->save();
        $data = [
            "expires_in" => now()->addMinutes(config("sanctum.expiration"))->format("Y-m-d H:i:s"),
            "token" => $token,
        ];

        return (object) [
            "statusCode" => Response::HTTP_OK,
            "message" => "Login berhasil!",
            "data" => $data,
            "is_active" => $account
        ];
    }

    public function doRegister(RegisterRequest $request): object
    {
        DB::beginTransaction();
        try {
            $this->authRepository->postRegister(
                name: $request->name,
                email: $request->email,
                password: $request->password,
                phone: '-'
            );
        } catch (\Throwable) {
            DB::rollBack();
            return (object) [
                "statusCode" => Response::HTTP_BAD_REQUEST,
                "code" => "register_failed",
                "message" => "Pendaftaran gagal"
            ];
        }
        DB::commit();

        $login = $this->doLogin($request->email, $request->password);

        // return (object) [
        //     "statusCode" => Response::HTTP_OK,
        //     "code" => "register_success",
        //     "message" => "Pendaftaran berhasil"
        // ];

        return $login;
    }

    public function doLogout(){
        auth()->user()->tokens()->delete();
        return (object) [
            "statusCode" => Response::HTTP_OK,
            "message" =>"Berhasil Logout!"
        ];
    }
}
