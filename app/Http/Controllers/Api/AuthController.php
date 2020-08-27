<?php

namespace App\Http\Controllers\Api;

use App\Domain\User\Models\BlockedIP;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\User\BlockedIP As BlockedIPResource;
use App\Http\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Resources\User\AuthenticatedUser as UserResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthController extends Controller
{
    use ApiResponse;

    private $_user_repository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->_user_repository = $userRepository;
    }

    public function login(LoginRequest $request)
    {
        $loginData = $request->only(['data.attributes.email', 'data.attributes.password']);
        if (!auth()->attempt($loginData['data']['attributes'])) {
            return $this->unauthorizedResponse(new JsonResource(['message' => 'Invalid Credentials']));
        }

        if (!auth()->user()->hasVerifiedEmail() || !auth()->user()->password_change_at) {
            return $this->unauthorizedResponse(new JsonResource(['message' => 'Your account has not been verified.']));
        }

        $accessToken = auth()->user()->createToken($request->input('data.attributes.device_name'))->plainTextToken;
        $user = $this->_user_repository->findWithRolesAndPermissions(auth()->user()->id);

        return $this->responseWithItem(new UserResource(
                [
                    'user' => $user,
                    'token' => $accessToken
                ]
            )
        );
    }

    public function blockUser(Request $request)
    {
        $remoteIdData = $request->only(['data.attributes.ip']);
        $block = BlockedIP::create([
            'ip' => $remoteIdData['data']['attributes']['ip'],
        ]);
        return $this->createdResponse(new BlockedIPResource($block));
    }

    public function isBlocked($ipAddress) {
        $isBlocked = BlockedIP::where('ip',$ipAddress)->first();
        if ($isBlocked) {
            return $this->responseWithItem(new BlockedIPResource($isBlocked));
        }
        return $this->responseResourceNotFound();
    }

    public function me()
    {
        $auth_user_id = Auth::user()->id;
        $user = $this->_user_repository->findWithRolesAndPermissions($auth_user_id);
        return $this->responseWithItem(new JsonResource(['user' => $user->toArray()]));
    }

}
