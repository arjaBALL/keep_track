<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccountableOfficer;
use App\Http\Requests\StoreAccountableOfficerRequest;
use App\Http\Requests\UpdateAccountableOfficerRequest;
use App\Http\Resources\AccountableOfficerResource;
use App\Services\AccountableOfficerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AccountableOfficerController extends Controller
{
    public function __construct(
        private readonly AccountableOfficerService $service,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $items = $this->service->paginate();

        return AccountableOfficerResource::collection($items);
    }

    public function store(StoreAccountableOfficerRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return (new AccountableOfficerResource($model))
            ->response()
            ->setStatusCode(201);
    }

    public function show(AccountableOfficer $accountableOfficer): AccountableOfficerResource
    {
        $model = $this->service->find($accountableOfficer->getKey());

        return new AccountableOfficerResource($model);
    }

    public function update(UpdateAccountableOfficerRequest $request, AccountableOfficer $accountableOfficer): AccountableOfficerResource
    {
        $model = $this->service->update($accountableOfficer, $request->validated());

        return new AccountableOfficerResource($model);
    }

    public function destroy(AccountableOfficer $accountableOfficer): JsonResponse
    {
        $this->service->delete($accountableOfficer);

        return response()->json(null, 204);
    }
}
