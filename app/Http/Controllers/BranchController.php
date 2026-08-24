<?php

namespace App\Http\Controllers;

use App\Http\Requests\Branch\StoreBranchRequest;
use App\Http\Requests\Branch\UpdateBranchRequest;
use App\Models\Branch;
use App\Services\BranchService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BranchController extends Controller
{
    public function __construct(protected BranchService $branches)
    {
    }

    public function index(Request $request): View
    {
        $branches = $this->branches->paginate($request->only(['search', 'is_active', 'per_page']));

        return view('branches.index', compact('branches'));
    }

    public function create(): View
    {
        return view('branches.create');
    }

    public function store(StoreBranchRequest $request): RedirectResponse
    {
        $this->branches->create($request->validated());

        return redirect()->route('branches.index')->with('success', __('app.messages.created'));
    }

    public function edit(Branch $branch): View
    {
        return view('branches.edit', compact('branch'));
    }

    public function update(UpdateBranchRequest $request, Branch $branch): RedirectResponse
    {
        $this->branches->update($branch, $request->validated());

        return redirect()->route('branches.index')->with('success', __('app.messages.updated'));
    }

    public function destroy(Branch $branch): RedirectResponse
    {
        try {
            $this->branches->delete($branch);
        } catch (\DomainException $e) {
            return back()->withErrors(['branch' => $e->getMessage()]);
        }

        return redirect()->route('branches.index')->with('success', __('app.messages.deleted'));
    }
}
