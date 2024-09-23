<?php

namespace App\Services\V1\Account;

use App\Exceptions\UnauthorizeException;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\AccountResource;
use App\Repositories\V1\Account\AccountRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountService
{
    public function __construct(
        protected AccountRepository $accountRepository
    ){}

    public function index()
    {
        $data = $this->accountRepository->getUser();

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
            "data" => new AccountResource($data)
        ];
    }

    public function saveUpdateProfile(ProfileRequest $profileRequest)
    {
        DB::beginTransaction();
        try {
            $this->accountRepository->updateProfile(
                name: $profileRequest->name,
                phone: $profileRequest->phone
            );
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return (object) [
            'statusCode' => Response::HTTP_OK,
            'message' => 'Data berhasil diperbaharui!',
        ];
    }

    public function deactiveAccount(Request $request)
    {
        $password = $request->only('password')['password'];

        $account = $this->accountRepository->getUser();

        if (!Hash::check(value: $password, hashedValue: $account->password)) {
            throw new UnauthorizeException(message: "Kata sandi yang anda masukan salah", code: Response::HTTP_UNAUTHORIZED);
        }

        $this->accountRepository->deactiveAccount();
        return (object) [
            'statusCode' => Response::HTTP_OK,
            'message' => 'Akun berhasil dihapus!',
        ];
    }
}
