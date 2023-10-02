<?php

namespace Creasi\Nusa\Http\Controllers;

use Creasi\Nusa\Contracts\District;
use Creasi\Nusa\Http\Requests\NusaRequest;
use Creasi\Nusa\Http\Resources\NusaResource;

final class DistrictController
{
    public function __construct(
        private District $model
    ) {
        // .
    }

    public function index(NusaRequest $request)
    {
        return NusaResource::collection($request->apply($this->model));
    }

    public function show(NusaRequest $request, int $district)
    {
        $district = $this->model->findOrFail($district);

        $district->load($request->relations($district));

        return new NusaResource($district);
    }

    public function villages(int $district)
    {
        $district = $this->model->findOrFail($district);

        return NusaResource::collection($district->villages()->paginate());
    }
}
