<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\VerificationCode;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository  implements UserRepositoryInterface
{
    public function findByPhone(string $phone,string $countryCode): ?User
    {
        return User::query()
            ->where('phone', $phone)
            ->where('country_code', $countryCode)
            ->first();
    }

    public function storeOtp($otp,$user): void
    {
         VerificationCode::query()->updateOrCreate(
             ['user_id' => $user->id],
             ['code' => $otp],
             ['exists' => true]
         );
    }

    public function verifyOtp($user,$otp): bool
    {
        $currentOtp = VerificationCode::query()
            ->where('user_id' , $user->id)
            ->latest()
            ->first();
        return $currentOtp?->code === $otp && $currentOtp->delete();
    }
}
