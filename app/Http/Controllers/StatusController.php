<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Status;
use App\Http\Requests\StoreStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Http\Resources\StatusResource;
use App\Services\StatusService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StatusController extends Controller
{
    public function __construct(
        private readonly StatusService $service,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $items = $this->service->paginate();

        return StatusResource::collection($items);
    }

    public function store(StoreStatusRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return (new StatusResource($model))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Status $status): StatusResource
    {
        $model = $this->service->find($status->getKey());

        return new StatusResource($model);
    }

    public function update(UpdateStatusRequest $request, Status $status): StatusResource
    {
        $model = $this->service->update($status, $request->validated());

        return new StatusResource($model);
    }

    public function destroy(Status $status): JsonResponse
    {
        $this->service->delete($status);

        return response()->json(null, 204);
    }
}
