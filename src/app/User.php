<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Current user types
     */
    public static $types = [
        'client' => 'client',
        'carrier' => 'carrier',
        'admin' => 'admin',
    ];

    /**
     * @inheritDoc
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @inheritDoc
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Creation rules for one user
     */
    public static $creationRules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|string|unique:users',
        'password' => 'required|string',
        'phone_number' => 'string',
        'is_client' => 'required|boolean',
    ];

    /**
     * Login rules for one user
     */
    public static $loginRules = [
        'email' => 'required|string',
        'password' => 'required|string',
    ];

    //Methods

    /**
     * Find user by the provided email
     *
     * @param string $email
     */
    public static function findByEmail($email)
    {
        return self::where([
            'email' => $email
        ])->first();
    }
}
