<?php

namespace App\Repositories\Otp;

use App\Models\Otp;
use App\Models\User;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

class OtpRepository extends BaseRepository implements OtpRepositoryInterface
{

    public function verifyCode(User $user, string $code): bool
    {
        $otp = Otp::query()
            ->active()
            ->where("user_id", $user->id)
            ->where("code", $code)
            ->firstOrFail();

        $otp->update(["used"=> true]);
        $user->update(["phone_verified_at"=> Carbon::now()]);

        return true;

    }
}
