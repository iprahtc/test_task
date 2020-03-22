<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\VerifiedRequest;
use App\Http\Resources\UserResource;
use App\Notifications\ConfirmationRegistrationNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request){
        $data = $request->validated();
        $data['password'] = bcrypt($request->validated()['password']);
        $data['verified_key'] = Str::random(32);
        $user = User::create($data);

        //send link verified
        $user->notify(new ConfirmationRegistrationNotification($data['verified_key']));

        return $this->getResponse(__('auth.verified'));
    }

    /**
     * @param LoginRequest $request
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request){
        if(!auth()->attempt($request->validated())){
            return $this->getErrorResponse(__('auth.user_not_found'));
        }

        $user = auth()->user();

        //check verified
        if(empty($user->email_verified_at) && !empty($user->verified_key)){
            return $this->getResponse(__('auth.verified'));
        }

        $user->accessTolen = $user->createToken('authToken')->accessToken;

        return new UserResource($user);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request){
        if(!$this->guard()->check()){
            return $this->getErrorResponse(__('auth.token_not_found'));
        }

        $request->user('api')->token()->revoke();
        auth()->guard()->logout();
        return $this->getResponse(__('auth.token_deleted'));
    }

    /**
     * @return mixed
     */
    protected function guard(){
        return auth()->guard('api');
    }

    /**
     * @param VerifiedRequest $request
     * @return UserResource
     */
    public function verified(VerifiedRequest $request){
        $user = User::where('verified_key', $request->validated()['key'])->first();

        $user->verified_key = null;
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();

        $user->accessTolen = $user->createToken('authToken')->accessToken;

        return new UserResource($user);
    }
}
