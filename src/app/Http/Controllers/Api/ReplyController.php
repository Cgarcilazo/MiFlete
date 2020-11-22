<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApi;
use Illuminate\Http\Request;
use App\User;
use App\Reply;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ReplyController extends BaseApi
{
    public function cancel(User $user, Reply $reply)
    {
        $package = new ResponsePackage();

        if (!$reply->isPending()) {
            return $package->setError('No es posible cancelar la oferta - estado distinto a pendiente', BaseApi::HTTP_CONFLICT)
                ->toResponse();
        }

        $reply->update([
            'status' => Reply::$status['canceled']
        ]);

        return $package->setMessage('Oferta Cancelada')
            ->setData('reply', $reply)
            ->toResponse();
    }
}
