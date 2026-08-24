<?php

namespace App\Http\Controllers;

use App\Http\Requests\PracticeArea\StorePracticeAreaRequest;
use App\Http\Requests\PracticeArea\UpdatePracticeAreaRequest;
use App\Models\PracticeArea;
use App\Services\PracticeAreaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PracticeAreaController extends Controller
{
    public function __construct(protected PracticeAreaService $practiceAreas)
    {
    }

    public function index(Request $request): View
    {
        $practiceAreas = $this->practiceAreas->paginate($request->only(['search', 'is_active', 'per_page']));

        return view('practice-areas.index', compact('practiceAreas'));
    }

    public function create(): View
    {
        return view('practice-areas.create');
    }

    public function store(StorePracticeAreaRequest $request): RedirectResponse
    {
        $this->practiceAreas->create($request->validated());

        return redirect()->route('practice-areas.index')->with('success', __('app.messages.created'));
    }

    public function edit(PracticeArea $practiceArea): View
    {
        return view('practice-areas.edit', compact('practiceArea'));
    }

    public function update(UpdatePracticeAreaRequest $request, PracticeArea $practiceArea): RedirectResponse
    {
        $this->practiceAreas->update($practiceArea, $request->validated());

        return redirect()->route('practice-areas.index')->with('success', __('app.messages.updated'));
    }

    public function destroy(PracticeArea $practiceArea): RedirectResponse
    {
        $this->practiceAreas->delete($practiceArea);

        return redirect()->route('practice-areas.index')->with('success', __('app.messages.deleted'));
    }
}
