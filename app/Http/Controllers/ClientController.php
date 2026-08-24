<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function __construct(protected ClientService $clients)
    {
    }

    public function index(Request $request): View
    {
        $clients = $this->clients->paginate($request->only(['search', 'type', 'per_page']));

        return view('clients.index', compact('clients'));
    }

    public function create(): View
    {
        return view('clients.create');
    }

    public function store(StoreClientRequest $request): RedirectResponse
    {
        $client = $this->clients->create($request->validated(), $request->user()->id);

        return redirect()->route('clients.show', $client)->with('success', __('app.messages.created'));
    }

    public function show(Client $client): View
    {
        $client->load(['cases.court', 'invoices', 'media']);

        return view('clients.show', compact('client'));
    }

    public function edit(Client $client): View
    {
        return view('clients.edit', compact('client'));
    }

    public function update(UpdateClientRequest $request, Client $client): RedirectResponse
    {
        $this->clients->update($client, $request->validated());

        return redirect()->route('clients.show', $client)->with('success', __('app.messages.updated'));
    }

    public function destroy(Client $client): RedirectResponse
    {
        $this->clients->delete($client);

        return redirect()->route('clients.index')->with('success', __('app.messages.deleted'));
    }
}
