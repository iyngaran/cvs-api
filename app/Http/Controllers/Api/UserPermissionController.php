<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserPermission;
use App\Http\Resources\User\Permission;
use App\Http\Resources\User\PermissionCollection;
use App\Http\Traits\ApiResponse;
use App\Domain\User\Repositories\PermissionRepositoryInterface;
use App\Domain\User\Actions\CreatePermissionAction;
use App\Domain\User\Actions\UpdatePermissionAction;
use App\Domain\User\Actions\DeletePermissionAction;
use App\Domain\User\DTOs\PermissionData;
use Illuminate\Http\JsonResponse;

class UserPermissionController extends Controller
{
    use ApiResponse;

    private $_permissions;

    public function __construct(PermissionRepositoryInterface $_permission_repository)
    {
        $this->_permissions = $_permission_repository;
    }


    public function index(): ?JsonResponse
    {
        return $this->responseWithCollection(
            new PermissionCollection($this->_permissions->all())
        );
    }


    public function store(UserPermission $request): ?JsonResponse
    {
        return $this->createdResponse(
            new Permission((new CreatePermissionAction())->execute(PermissionData::fromRequest($request)))
        );
    }


    public function show($id)
    {
        return $this->responseWithItem(
            new Permission($this->_permissions->find($id))
        );
    }


    public function update(UserPermission $request, $id)
    {
        return $this->updatedResponse(
            new Permission((new UpdatePermissionAction())->execute(PermissionData::fromRequest($request), $id))
        );
    }


    public function destroy($id)
    {
        return $this->deletedResponse(
            (new DeletePermissionAction())->execute($id)
        );
    }
}
