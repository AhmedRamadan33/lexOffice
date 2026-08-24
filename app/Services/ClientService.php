<?php

namespace App\Services;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientService
{
    public function __construct(protected ClientRepositoryInterface $clients)
    {
    }

    public function paginate(array $filters): LengthAwarePaginator
    {
        return $this->clients->paginate($filters);
    }

    public function create(array $data, int $userId): Client
    {
        $data['created_by'] = $userId;

        return $this->clients->create($data);
    }

    public function update(Client $client, array $data): Client
    {
        return $this->clients->update($client, $data);
    }

    public function delete(Client $client): bool
    {
        return $this->clients->delete($client);
    }
}
