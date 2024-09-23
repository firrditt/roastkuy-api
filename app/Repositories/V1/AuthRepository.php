<?php

namespace App\Repositories\V1;

use App\Models\Account;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

class AuthRepository
{
    public function findAccountByEmail(string $email): Account | null
    {
        return Account::select()->where('email', $email)->first();
    }

    public function postRegister(
        string $name,
        string $email,
        string $password,
        string $phone,
    ): Account{
        DB::beginTransaction();
        try {
            $account = Account::create([
                'name'    => $name,
                'email'   => $email,
                'password'=> $password,
                'phone'   => $phone,
                'roles'   => 1,
                'status'  => 1,
                'member_number' => Account::generateMemberNumber()
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        DB::commit();
        return $account;
    }
}
