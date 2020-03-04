<?php

namespace App\Providers;

use App\Users;
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
        $this->app['auth']->viaRequest('api', static function ($request) {
            if ($request->input('api_token')) {
                return Users::where('api_token', $request->input('api_token'))->first();
            }

            if ($request->header('Authorization')) {
                $bearer = $request->header('Authorization');
                $exploded_bearer = explode(' ', $bearer);
                $token = $exploded_bearer[1];

                return Users::where('api_token', $token)->first();
            }
        });
    }
}
