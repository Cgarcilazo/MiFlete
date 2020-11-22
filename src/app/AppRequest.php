<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppRequest extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $table = 'requests';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'date',
    ];

    protected $appends = [
        'origin_full_address',
        'destination_full_address',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category',
        'status',
        'description',
        'date',
        'user_id',
        'province_origin',
        'province_destination',
        'city_origin',
        'city_destination',
        'street_origin',
        'street_destination',
        'street_number_origin',
        'street_number_destination',
        'flat_number_origin',
        'flat_number_destination',
        'flat_letter_origin',
        'flat_letter_destination',
        'preferred_hour',
        'range_hour_from',
        'range_hour_to',
        'need_more_carriers',
        'is_elevator_origin',
        'is_elevator_destination',
        'clarifications',
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
     * The available status for the client request
     */
    public static $status = [
        'pending' => 'Pendiente',
        'reserved' => 'Reservado',
        'canceled' => 'Cancelado',
        'done' => 'Realizado',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category' => 'string',
        'status' => 'string',
        'description' => 'string',
        'user_id' => 'integer',
        'province_origin' => 'string',
        'province_destination' => 'string',
        'city_origin' => 'string',
        'city_destination' => 'string',
        'street_origin' => 'string',
        'street_destination' => 'string',
        'street_number_origin' => 'string',
        'street_number_destination' => 'string',
        'flat_number_origin' => 'string',
        'flat_number_destination' => 'string',
        'flat_letter_origin' => 'string',
        'flat_letter_destination' => 'string',
        'need_more_carriers' => 'boolean',
        'is_elevator_origin' => 'boolean',
        'is_elevator_destination' => 'boolean',
        'clarifications' => 'string',
        'date' => 'datetime:d-m-Y',
    ];

    /**
     * Creation rules for a request
     */
    public static $creationRules = [
        'description' => 'required|string',
        'province_origin' => 'required|string',
        'province_destination' => 'required|string',
        'city_origin' => 'required|string',
        'city_destination' => 'required|string',
        'street_origin' => 'required|string',
        'street_destination' => 'required|string',
        'street_number_origin' => 'required|numeric',
        'street_number_destination' => 'required|numeric',
        'flat_number_origin' => 'nullable|numeric',
        'flat_number_destination' => 'nullable|numeric',
        'flat_letter_origin' => 'nullable|string',
        'flat_letter_destination' => 'nullable|string',
        'need_more_carriers' => 'nullable|boolean',
        'is_elevator_origin' => 'nullable|boolean',
        'is_elevator_destination' => 'nullable|boolean',
        'clarifications' => 'nullable|string',
    ];

    // Relationships

    public function replies()
    {
        return $this->hasMany(Reply::class, 'request_id');
    }

    // Methods

    /**
     * Get the origin full address in the correct format
     */
    public function getOriginFullAddressAttribute()
    {
        $flat = $this->flat_number_origin != '' ? ' - Piso ' . $this->flat_number_origin : '';
        $flatLetter =  $this->flat_letter_origin != '' ? ' - Dpto ' . $this->flat_letter_origin : '';

        return $this->city_origin . ' - ' . $this->street_origin . ' - ' . $this->street_number_origin
            .  $flat . $flatLetter;
    }

    /**
     * Get the destination full address in the correct format
     */
    public function getDestinationFullAddressAttribute()
    {
        $flat = $this->flat_number_destination != '' ? ' - Piso ' . $this->flat_number_destination : '';
        $flatLetter =  $this->flat_letter_destination != '' ? ' - Dpto ' . $this->flat_letter_destination : '';

        return $this->city_destination . ' - ' . $this->street_destination . ' - ' . $this->street_number_destination
            .  $flat . $flatLetter;
    }

    /**
     * Get quantity of replies for the given request
     */
    public function getRepliesCountAttribute()
    {
        return $this->replies()
        ->where('status', '<>', Reply::$status['canceled'])
        ->where('status', '<>', Reply::$status['rejected'])
        ->count();
    }

    /**
     * Check if the current request is pending
     */
    public function isPending()
    {
        return $this->status == self::$status['pending'];
    }

    /**
     * Check if the current reques has replies
     */
    public function hasReplies()
    {
        return $this->replies()->count() > 0;
    }
}
