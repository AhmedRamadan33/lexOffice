<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuccessStory\StoreSuccessStoryRequest;
use App\Http\Requests\SuccessStory\UpdateSuccessStoryRequest;
use App\Models\SuccessStory;
use App\Services\SuccessStoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SuccessStoryController extends Controller
{
    public function __construct(protected SuccessStoryService $stories)
    {
    }

    public function index(Request $request): View
    {
        $stories = $this->stories->paginate($request->only(['search', 'category', 'is_active', 'per_page']));

        return view('success-stories.index', compact('stories'));
    }

    public function create(): View
    {
        return view('success-stories.create');
    }

    public function store(StoreSuccessStoryRequest $request): RedirectResponse
    {
        $this->stories->create($request->validated(), $request);

        return redirect()->route('success-stories.index')->with('success', __('app.messages.created'));
    }

    public function edit(SuccessStory $successStory): View
    {
        return view('success-stories.edit', ['story' => $successStory]);
    }

    public function update(UpdateSuccessStoryRequest $request, SuccessStory $successStory): RedirectResponse
    {
        $this->stories->update($successStory, $request->validated(), $request);

        return redirect()->route('success-stories.index')->with('success', __('app.messages.updated'));
    }

    public function destroy(SuccessStory $successStory): RedirectResponse
    {
        $this->stories->delete($successStory);

        return redirect()->route('success-stories.index')->with('success', __('app.messages.deleted'));
    }
}
