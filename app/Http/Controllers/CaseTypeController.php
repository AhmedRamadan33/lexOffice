<?php

namespace App\Http\Controllers;

use App\Http\Requests\CaseType\StoreCaseTypeRequest;
use App\Http\Requests\CaseType\UpdateCaseTypeRequest;
use App\Models\CaseType;
use App\Services\CaseTypeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CaseTypeController extends Controller
{
    public function __construct(protected CaseTypeService $caseTypes)
    {
    }

    public function index(Request $request): View
    {
        $caseTypes = $this->caseTypes->paginate($request->only(['search', 'is_active', 'per_page']));

        return view('case_types.index', compact('caseTypes'));
    }

    public function store(StoreCaseTypeRequest $request): RedirectResponse
    {
        $this->caseTypes->create($request->validated());

        return redirect()->route('case-types.index')->with('success', __('app.messages.created'));
    }

    public function update(UpdateCaseTypeRequest $request, CaseType $case_type): RedirectResponse
    {
        $this->caseTypes->update($case_type, $request->validated());

        return redirect()->route('case-types.index')->with('success', __('app.messages.updated'));
    }

    public function destroy(CaseType $case_type): RedirectResponse
    {
        $this->caseTypes->delete($case_type);

        return redirect()->route('case-types.index')->with('success', __('app.messages.deleted'));
    }
}
