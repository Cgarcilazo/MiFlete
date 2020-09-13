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
     * Attributes that should be appended by default
     */
    protected $appends = [
        'is_client',
        'is_carrier',
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
        'confirm_password' => 'required|string|same:password',
        'phone_number' => 'string|nullable',
        'is_client' => 'required|boolean',
    ];

    /**
     * Creation messages
     */
    public static $creationMessages = [
        'nombre.required' => 'El nombre es requerido',
        'nombre.string' => 'El nombre debe ser un string',
        'apellido.required' => 'El apellido es requerido',
        'apellido.string' => 'El apellido debe ser un string',
        'email.required' => 'El email es requerido',
        'email.string' => 'El email debe ser un string',
        'email.unique' => 'El email ya existe',
        'password.required' => 'La contraseña es requerida',
        'password.string' => 'La contraseña debe ser un string',
        'confirm_password.required' => 'La confirmación de contraseña es requerida',
        'confirm_password.string' => 'La confirmación de contraseña debe ser un string',
        'confirm_password.same' => 'La confirmación de contraseña debe ser igual a la contraseña ingresada',
        'phone_number.string' => 'El número de teléfono debe ser un string',
        'is_client.required' => 'Debe indicar si es cliente o transportista',
        'is_client.boolean' => 'Debe proporcionar un valor booleano indicando si es cliente o transportista',
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

    /**
     * Check if the current user is a client
     */
    public function getIsClientAttribute()
    {
        return $this->type === self::$types['client'];
    }

    /**
     * Check if the current user is a carrier
     */
    public function getIsCarrierAttribute()
    {
        return $this->type === self::$types['carrier'];
    }
}
