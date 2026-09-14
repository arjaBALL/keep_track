<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $service,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $items = $this->service->paginate();

        return UserResource::collection($items);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return (new UserResource($model))
            ->response()
            ->setStatusCode(201);
    }

    public function show(User $user): UserResource
    {
        $model = $this->service->find($user->getKey());

        return new UserResource($model);
    }

    public function update(UpdateUserRequest $request, User $user): UserResource
    {
        $model = $this->service->update($user, $request->validated());

        return new UserResource($model);
    }

    public function destroy(User $user): JsonResponse
    {
        $this->service->delete($user);

        return response()->json(null, 204);
    }
}
