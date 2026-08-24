<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct(protected ClientService $clients)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $clients = $this->clients->paginate($request->only(['search', 'type', 'per_page']));

        return response()->json(ClientResource::collection($clients)->response()->getData(true));
    }

    public function store(StoreClientRequest $request): JsonResponse
    {
        $client = $this->clients->create($request->validated(), $request->user()->id);

        return response()->json(new ClientResource($client), 201);
    }

    public function show(Client $client): JsonResponse
    {
        return response()->json(new ClientResource($client));
    }

    public function update(UpdateClientRequest $request, Client $client): JsonResponse
    {
        $this->clients->update($client, $request->validated());

        return response()->json(new ClientResource($client));
    }

    public function destroy(Client $client): JsonResponse
    {
        $this->clients->delete($client);

        return response()->json(null, 204);
    }
}
