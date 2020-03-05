<?php

namespace App\Providers;

use App\todo\Domain\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        /** @var UserRepositoryInterface $userRepository */
        $userRepository = $this->app->get(UserRepositoryInterface::class);

        $this->app['auth']->viaRequest('api', static function ($request) use ($userRepository) {

            if ($request->input('api_token')) {
                return $userRepository->findUserByApiToken($request->input('api_token', ''));
            }

            if ($request->header('Authorization')) {
                $bearer = $request->header('Authorization');
                $exploded_bearer = explode(' ', $bearer);
                $token = $exploded_bearer[1];

                return $userRepository->findUserByApiToken((string)$token);
            }
        });
    }
}
