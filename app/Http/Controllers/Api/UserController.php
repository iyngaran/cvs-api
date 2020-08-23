<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Domain\User\Actions\CreateUserAction;
use App\Domain\User\Actions\UpdateUserAction;
use App\Domain\User\Actions\DeleteUserAction;
use App\Domain\User\DTOs\UserData;
use App\Http\Requests\User\User as UserRequest;
use App\Http\Resources\User\User as UserResource;
use App\Http\Resources\User\UserCollection;

class UserController extends Controller
{
    use ApiResponse;

    private $_user;

    public function __construct(UserRepositoryInterface $_user_repository)
    {
        $this->_user = $_user_repository;
    }


    public function index(): ?JsonResponse
    {
        return $this->responseWithCollection(
            new UserCollection($this->_user->all())
        );
    }


    public function store(UserRequest $request): ?JsonResponse
    {
        return $this->createdResponse(
            new UserResource((new CreateUserAction())->execute(UserData::fromRequest($request)))
        );
    }


    public function show($id)
    {
        return $this->responseWithItem(
            new UserResource($this->_user->find($id))
        );
    }


    public function update(UserRequest $request, $id)
    {
        return $this->updatedResponse(
            new UserResource((new UpdateUserAction())->execute(UserData::fromRequest($request), $id))
        );
    }

    public function destroy($id)
    {
        return $this->deletedResponse(
            (new DeleteUserAction())->execute($id)
        );
    }
}
