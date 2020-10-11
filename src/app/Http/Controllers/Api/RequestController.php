<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApi;
use App\Http\Requests\CreateRequestForClient;
use App\Request as ClientRequest;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class RequestController extends BaseApi
{
    /**
     * Store one particular request for the given user
     *
     * @param  User $user
     *
     * @param  CreateRequestForClient $request
     *
     * @return JsonResponse
     */
    public function store(User $user, CreateRequestForClient $request)
    {
        $package = new ResponsePackage();

        DB::beginTransaction();
        try {
            $moreCarriers = filter_var($request->need_more_carriers, FILTER_VALIDATE_BOOLEAN);
            $elevatorOrigin = filter_var($request->is_elevator_origin, FILTER_VALIDATE_BOOLEAN);
            $elevatorElevator = filter_var($request->is_elevator_destination, FILTER_VALIDATE_BOOLEAN);

            $clientRequest = ClientRequest::create([
                'category' => 'not used yet',
                'status' => ClientRequest::$status['pending'],
                'description' => $request->description,
                'province_origin' => $request->province_origin,
                'province_destination' => $request->province_destination,
                'date' => $request->date,
                'user_id' => $user->id,
                'city_origin' => $request->city_origin,
                'city_destination' => $request->city_destination,
                'street_origin' => $request->street_origin,
                'street_destination' => $request->street_destination,
                'street_number_origin' => $request->street_number_origin,
                'street_number_destination' => $request->street_number_destination,
                'flat_number_origin' => !empty($request->flat_number_origin),
                'flat_number_destination' => !empty($request->flat_number_destination) ? $request->flat_number_destination : '',
                'flat_letter_origin' => !empty($request->flat_letter_origin) ? $request->flat_letter_origin : '',
                'flat_letter_destination' => !empty($request->flat_letter_destination) ? $request->flat_letter_destination : '',
                'preferred_hour' => !empty($request->preferred_hour) ? $request->preferred_hour : '',
                'range_hour_from' => !empty($request->range_hour_from) ? $request->range_hour_from : '',
                'range_hour_to' => !empty($request->range_hour_to) ? $request->range_hour_to : '',
                'need_more_carriers' => $moreCarriers,
                'is_elevator_origin' => $elevatorOrigin,
                'is_elevator_destination' => $elevatorElevator,
                'clarifications' => !empty($request->clarifications) ? $request->clarifications : '',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $package->setError('Hubo un problema creando la solicitud, contacte un administrador', BaseApi::HTTP_CONFLICT)
                ->toResponse();
        }

        DB::commit();
        return $package->setMessage('Solicitud Creada')
            ->setData('solicitud', $clientRequest)
            ->toResponse();
    }
}
