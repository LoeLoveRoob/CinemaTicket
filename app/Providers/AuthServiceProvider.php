<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Cinema;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use App\Policies\ArtistPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\CinemaPolicy;
use App\Policies\GenrePolicy;
use App\Policies\MoviePolicy;
use App\Policies\RolePolicy;
use App\Policies\TicketPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Cinema::class => CinemaPolicy::class,
        Category::class => CategoryPolicy::class,
        Genre::class => GenrePolicy::class,
        Movie::class => MoviePolicy::class,
        Role::class => RolePolicy::class,
        Ticket::class => TicketPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
