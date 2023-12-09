<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

public function query(array $payload = []): QueryBuilder
{
    return QueryBuilder::for(User::class)
        ->allowedIncludes(["roles", "movies", "tickets"])
        ->allowedFilters([
            AllowedFilter::scope("role"),
        ]);

}

    public function verifyUser(User $user): User
    {
        $user->update([
            "phone_verified_at" => now(),
        ]);
        return $user;
    }

    public function generateToken(User $user): string
    {
        return $user->createToken("Rahman")->plainTextToken;
    }
}
