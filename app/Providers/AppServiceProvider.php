<?php

namespace App\Providers;

use App\Models\User;
use App\Repository\DBUsersRepository;
use App\Repository\DBCreditRepository;
use Illuminate\Support\ServiceProvider;

use App\Repository\DBNotificationRepository;
use App\Repository\DBExtraServicesRepository;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Repositoryinterface\UsersRepositoryinterface;
use App\Repositoryinterface\CreditRepositoryinterface;
use App\Repositoryinterface\NotificationRepositoryinterface;
use App\Repositoryinterface\ExtraServicesRepositoryinterface;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $repositories = [
            UsersRepositoryinterface::class                => DBUsersRepository::class,
            // CreditRepositoryinterface::class               => DBCreditRepository::class,
            // ExtraServicesRepositoryinterface::class        => DBExtraServicesRepository::class,
            // NotificationRepositoryinterface::class        => DBNotificationRepository::class,
        ];
        foreach ($repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::morphMap([
            'driver' => User::class,
            'user'   => User::class
        ]);
    }
}
