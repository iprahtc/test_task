<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    public function subscribe(User $user){
        if($user->id === auth()->user()->id)
            return $this->getErrorResponse(__('massages.subscription_to_yourself'));

        Subscription::firstOrCreate([
            'user_id' => auth()->user()->id,
            'to_user_id' => $user->id
        ]);

        return $this->getSuccessResponse();
    }

    public function unsubscribe(User $user){
        $subscribe = Subscription::where('user_id', auth()->user()->id)->where('to_user_id', $user->id)->first();
        if($subscribe) {
            $subscribe->delete();
            return $this->getSuccessResponse();
        }

        return $this->getErrorResponse(__('massages.subscription_not_found'));
    }
}
