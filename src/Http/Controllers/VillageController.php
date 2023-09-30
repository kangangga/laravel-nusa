<?php

namespace Creasi\Nusa\Http\Controllers;

use Creasi\Nusa\Http\Requests\NusaRequest;
use Creasi\Nusa\Http\Resources\NusaResource;
use Creasi\Nusa\Models\Village;

class VillageController
{
    public function index(NusaRequest $request, Village $village)
    {
        return NusaResource::collection($request->apply($village));
    }

    public function show(NusaRequest $request, int $village)
    {
        $village = Village::query()->findOrFail($village);

        $village->load($request->relations($village));

        return new NusaResource($village);
    }
}
