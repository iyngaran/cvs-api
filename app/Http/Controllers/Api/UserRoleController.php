<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRole as UserRoleRequest;
use App\Http\Resources\User\Role as UserRoleResource;
use App\Http\Resources\User\RoleCollection;
use App\Http\Traits\ApiResponse;
use App\Domain\User\Repositories\RoleRepositoryInterface;
use App\Domain\User\Actions\CreateRoleAction;
use App\Domain\User\Actions\UpdateRoleAction;
use App\Domain\User\Actions\DeleteRoleAction;
use App\Domain\User\DTOs\RoleData;
use Illuminate\Http\JsonResponse;

class UserRoleController extends Controller
{
    use ApiResponse;

    private $_role;

    public function __construct(RoleRepositoryInterface $_role_repository)
    {
        $this->_role = $_role_repository;
    }

    public function index(): ?JsonResponse
    {
        return $this->responseWithCollection(
            new RoleCollection($this->_role->all())
        );
    }


    public function store(UserRoleRequest $request): ?JsonResponse
    {
        return $this->createdResponse(
            new UserRoleResource((new CreateRoleAction())->execute(RoleData::fromRequest($request)))
        );
    }


    public function show($id)
    {
        return $this->responseWithItem(
            new UserRoleResource($this->_role->find($id))
        );
    }


    public function update(UserRoleRequest $request, $id)
    {
        return $this->updatedResponse(
            new UserRoleResource((new UpdateRoleAction())->execute(RoleData::fromRequest($request), $id))
        );
    }


    public function destroy($id)
    {
        return $this->deletedResponse(
            (new DeleteRoleAction())->execute($id)
        );
    }
}
