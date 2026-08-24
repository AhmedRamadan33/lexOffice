<?php

namespace App\Http\Controllers;

use App\Http\Requests\CaseModel\StoreCaseRequest;
use App\Http\Requests\CaseModel\UpdateCaseRequest;
use App\Models\CaseModel;
use App\Models\CaseType;
use App\Models\Client;
use App\Models\Court;
use App\Models\User;
use App\Services\CaseService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CaseController extends Controller
{
    public function __construct(protected CaseService $cases)
    {
    }

    public function index(Request $request): View
    {
        $cases = $this->cases->paginate($request->only(['search', 'status', 'court_id', 'case_type_id', 'assigned_lawyer_id', 'per_page']));

        return view('cases.index', [
            'cases' => $cases,
            'courts' => Court::orderBy('name->ar')->get(),
            'caseTypes' => CaseType::orderBy('name->ar')->get(),
            'lawyers' => User::where('is_active', true)->orderBy('name->ar')->get(),
        ]);
    }

    public function create(): View
    {
        return view('cases.create', $this->formData());
    }

    public function store(StoreCaseRequest $request): RedirectResponse
    {
        $case = $this->cases->create($request->validated(), $request->user()->id);

        return redirect()->route('cases.show', $case)->with('success', __('app.messages.created'));
    }

    public function show(CaseModel $case): View
    {
        $case->load(['client', 'court', 'caseType', 'assignedLawyer', 'sessions' => fn ($q) => $q->orderByDesc('session_date'), 'invoices', 'tasks', 'media']);

        return view('cases.show', compact('case'));
    }

    public function edit(CaseModel $case): View
    {
        return view('cases.edit', [...$this->formData(), 'case' => $case]);
    }

    public function update(UpdateCaseRequest $request, CaseModel $case): RedirectResponse
    {
        $this->cases->update($case, $request->validated());

        return redirect()->route('cases.show', $case)->with('success', __('app.messages.updated'));
    }

    public function destroy(CaseModel $case): RedirectResponse
    {
        $this->cases->delete($case);

        return redirect()->route('cases.index')->with('success', __('app.messages.deleted'));
    }

    private function formData(): array
    {
        return [
            'clients' => Client::orderBy('name->ar')->get(),
            'courts' => Court::where('is_active', true)->orderBy('name->ar')->get(),
            'caseTypes' => CaseType::where('is_active', true)->orderBy('name->ar')->get(),
            'lawyers' => User::where('is_active', true)->orderBy('name->ar')->get(),
        ];
    }
}
