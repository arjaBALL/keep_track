<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoleController extends Controller
{
    public function __construct(
        private readonly RoleService $service,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $items = $this->service->paginate();

        return RoleResource::collection($items);
    }

    public function store(StoreRoleRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return (new RoleResource($model))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Role $role): RoleResource
    {
        $model = $this->service->find($role->getKey());

        return new RoleResource($model);
    }

    public function update(UpdateRoleRequest $request, Role $role): RoleResource
    {
        $model = $this->service->update($role, $request->validated());

        return new RoleResource($model);
    }

    public function destroy(Role $role): JsonResponse
    {
        $this->service->delete($role);

        return response()->json(null, 204);
    }
}
