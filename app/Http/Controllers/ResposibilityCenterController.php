<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ResposibilityCenter;
use App\Http\Requests\StoreResposibilityCenterRequest;
use App\Http\Requests\UpdateResposibilityCenterRequest;
use App\Http\Resources\ResposibilityCenterResource;
use App\Services\ResposibilityCenterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ResposibilityCenterController extends Controller
{
    public function __construct(
        private readonly ResposibilityCenterService $service,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $items = $this->service->paginate();

        return ResposibilityCenterResource::collection($items);
    }

    public function store(StoreResposibilityCenterRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return (new ResposibilityCenterResource($model))
            ->response()
            ->setStatusCode(201);
    }

    public function show(ResposibilityCenter $resposibilityCenter): ResposibilityCenterResource
    {
        $model = $this->service->find($resposibilityCenter->getKey());

        return new ResposibilityCenterResource($model);
    }

    public function update(UpdateResposibilityCenterRequest $request, ResposibilityCenter $resposibilityCenter): ResposibilityCenterResource
    {
        $model = $this->service->update($resposibilityCenter, $request->validated());

        return new ResposibilityCenterResource($model);
    }

    public function destroy(ResposibilityCenter $resposibilityCenter): JsonResponse
    {
        $this->service->delete($resposibilityCenter);

        return response()->json(null, 204);
    }
}
