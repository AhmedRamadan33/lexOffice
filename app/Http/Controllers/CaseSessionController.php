<?php

namespace App\Http\Controllers;

use App\Http\Requests\CaseSession\StoreSessionRequest;
use App\Http\Requests\CaseSession\UpdateSessionRequest;
use App\Models\CaseModel;
use App\Models\CaseSession;
use App\Models\Court;
use App\Services\CaseSessionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CaseSessionController extends Controller
{
    public function __construct(protected CaseSessionService $sessions)
    {
    }

    public function indexAll(Request $request): View
    {
        $sessions = $this->sessions->paginate($request->only(['search', 'status', 'court_id', 'per_page']));

        return view('sessions.index', [
            'sessions' => $sessions,
            'courts' => Court::orderBy('name->ar')->get(),
        ]);
    }

    public function create(CaseModel $case): View
    {
        return view('sessions.create', [
            'case' => $case,
            'courts' => Court::where('is_active', true)->orderBy('name->ar')->get(),
        ]);
    }

    public function store(StoreSessionRequest $request, CaseModel $case): RedirectResponse
    {
        $this->sessions->create($case, $request->validated(), $request->user()->id);

        return redirect()->route('cases.show', $case)->with('success', __('app.messages.created'));
    }

    public function edit(CaseModel $case, CaseSession $session): View
    {
        return view('sessions.edit', [
            'case' => $case,
            'session' => $session,
            'courts' => Court::where('is_active', true)->orderBy('name->ar')->get(),
        ]);
    }

    public function update(UpdateSessionRequest $request, CaseModel $case, CaseSession $session): RedirectResponse
    {
        $this->sessions->update($session, $request->validated());

        return redirect()->route('cases.show', $case)->with('success', __('app.messages.updated'));
    }

    public function destroy(CaseModel $case, CaseSession $session): RedirectResponse
    {
        $this->sessions->delete($session);

        return redirect()->route('cases.show', $case)->with('success', __('app.messages.deleted'));
    }
}
