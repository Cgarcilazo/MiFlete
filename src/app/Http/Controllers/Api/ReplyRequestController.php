<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApi;
use Illuminate\Http\Request;
use App\User;
use App\AppRequest;
use App\Reply;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ReplyRequestController extends BaseApi
{
    /**
     * Get all replies for a given request
     *
     * @param User $user
     *
     * @param AppRequest $appRequest
     *
     * @return JsonResponse
     */
    public function index(User $user, AppRequest $appRequest)
    {
        $package = new ResponsePackage();

        $replies = $appRequest->replies()
            ->where('status', '<>', Reply::$status['canceled'])
            ->where('status', '<>', Reply::$status['rejected'])
            ->get();

        return $package->setMessage('Lista de ofertas')
            ->setData('replies', $replies)
            ->toResponse();
    }

    /**
     * Create a reply for a given request
     *
     * @param User $user
     *
     * @param AppRequest $appRequest
     *
     * @return JsonResponse
     */
    public function store(User $user, AppRequest $appRequest, Request $request)
    {
        $package = new ResponsePackage();

        DB::beginTransaction();

        try {
            $reply = Reply::create([
                'user_id' => $user->id,
                'request_id' => $appRequest->id,
                'price' => $request->price,
                'status' => Reply::$status['pending'],
                'description' => $request->description
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $package->setError('Hubo un problema creando la oferta, contacte un administrador', BaseApi::HTTP_CONFLICT)
                ->toResponse();
        }

        DB::commit();
        return $package->setMessage('Oferta Creada')
            ->setData('reply', $reply)
            ->toResponse();
    }

    /**
     * Accept the current reply for a given request
     *
     * @param User $user
     *
     * @param AppRequest $appRequest
     *
     * @param Reply $reply
     *
     * @return JsonResponse
     */
    public function accept(User $user, AppRequest $appRequest, Reply $reply)
    {
        $package = new ResponsePackage();

        if ($reply->isCanceled() || $reply->isRejected()) {
            return $package->setError('No es posible aceptar una solicitud cancelada o rechazada', BaseApi::HTTP_CONFLICT)
                ->toResponse();
        }

        DB::beginTransaction();

        try {
            $allReplies = $appRequest->replies()->get();

            foreach ($allReplies as $allReply) {
                if ($allReply->id != $reply->id) {
                    $allReply->update([
                        'status' => Reply::$status['rejected']
                    ]);
                }
            }

            $reply->update([
                'status' => Reply::$status['accepted']
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $package->setError('No es posible aceptar la solicitud, contacte a un administrador', BaseApi::HTTP_CONFLICT)
                ->toResponse();
        }

        DB::commit();
        return $package->setMessage('Oferta Aceptada')
            ->setData('reply', $reply)
            ->toResponse();
    }
}
