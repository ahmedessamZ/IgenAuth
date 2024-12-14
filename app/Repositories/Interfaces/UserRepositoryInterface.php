<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findByPhone(string $phone,string $countryCode): ?User;
    public function storeOtp($otp,$user);
    public function verifyOtp($user,$otp): bool;
}
