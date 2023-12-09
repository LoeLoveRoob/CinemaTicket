<?php

namespace App\Repositories\Otp;

use App\Models\Otp;
use App\Models\User;
use App\Repositories\BaseRepositoryInterface;

interface OtpRepositoryInterface extends BaseRepositoryInterface
{
    public function verifyCode(User $user, string $code): bool;
}
