<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $table = 'replies';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price',
        'status',
        'description',
        'user_id',
        'request_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    /**
     * The available status for the reply
     */
    public static $status = [
        'pending' => 'Pendiente',
        'accepted' => 'Aceptada',
        'canceled' => 'Cancelado',
        'rejected' => 'Rechazada',
        'done' => 'Realizado',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'price' => 'decimal,8:2',
        'status' => 'string',
        'description' => 'string',
        'user_id' => 'integer',
        'request_id' => 'integer',
    ];

    // Methods

    /**
     * Check if the current reply is pending
     */
    public function isPending()
    {
        return $this->status == self::$status['pending'];
    }

    /**
     * Check if the current reply is canceled
     */
    public function isCanceled()
    {
        return $this->status == self::$status['canceled'];
    }

    /**
     * Check if the current reply is rejected
     */
    public function isRejected()
    {
        return $this->status == self::$status['rejected'];
    }
}
