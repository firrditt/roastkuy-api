<?php

namespace App\Repositories\V1\Account;

use App\Models\Account;
use Illuminate\Support\Facades\DB;

class AccountRepository
{
    public function getUser()
    {
        return Account::with('promos')->select()->where('id', auth()->user()->id)->first();
    }

    public function getUserByUuid($uuid)
    {
        return Account::with('promos')->select()->where('uuid', $uuid)->first();
    }

    public function updateProfile(string $name, string $phone)
    {
        DB::beginTransaction();
        try {
            $user = $this->getUser();
            $user->update([
                'name' => $name,
                'phone' => $phone
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $user;
    }

    public function updateActive($uuid)
    {
        DB::beginTransaction();
        try {
            $user = $this->getUserByUuid($uuid);
            // $user->phone_verified_at = now();
            $user->email_verified_at = now();
            $user->save();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $user;
    }

    public function deactiveAccount()
    {
        DB::beginTransaction();
        try {
            $user = $this->getUser();
            $user->status = 5;
            $user->save();
        } catch (\Throwable $e) {
            throw $e;
        }
        DB::commit();
    }
}
