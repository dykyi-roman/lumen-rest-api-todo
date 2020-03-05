<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Users extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected array $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile_number',
        'gender',
        'birthday',
        'password',
        'api_token'
    ];

    protected array $hidden = ['password', 'api_token'];

    public function todo()
    {
        return $this->hasMany(Todo::class,'user_id');
    }
}
