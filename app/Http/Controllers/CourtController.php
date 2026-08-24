<?php

namespace App\Http\Controllers;

use App\Http\Requests\Court\StoreCourtRequest;
use App\Http\Requests\Court\UpdateCourtRequest;
use App\Models\Court;
use App\Services\CourtService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourtController extends Controller
{
    public function __construct(protected CourtService $courts)
    {
    }

    public function index(Request $request): View
    {
        $courts = $this->courts->paginate($request->only(['search', 'is_active', 'per_page']));

        return view('courts.index', compact('courts'));
    }

    public function store(StoreCourtRequest $request): RedirectResponse
    {
        $this->courts->create($request->validated());

        return redirect()->route('courts.index')->with('success', __('app.messages.created'));
    }

    public function update(UpdateCourtRequest $request, Court $court): RedirectResponse
    {
        $this->courts->update($court, $request->validated());

        return redirect()->route('courts.index')->with('success', __('app.messages.updated'));
    }

    public function destroy(Court $court): RedirectResponse
    {
        $this->courts->delete($court);

        return redirect()->route('courts.index')->with('success', __('app.messages.deleted'));
    }
}
