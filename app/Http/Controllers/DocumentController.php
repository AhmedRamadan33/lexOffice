<?php

namespace App\Http\Controllers;

use App\Http\Requests\Document\StoreDocumentRequest;
use App\Services\DocumentService;
use Illuminate\Http\RedirectResponse;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DocumentController extends Controller
{
    public function __construct(protected DocumentService $documents)
    {
    }

    public function store(StoreDocumentRequest $request, string $type, int $id): RedirectResponse
    {
        $this->documents->upload($type, $id, $request);

        return back()->with('success', __('app.messages.created'));
    }

    public function toggleVisibility(Media $media): RedirectResponse
    {
        $this->documents->toggleVisibility($media);

        return back()->with('success', __('app.messages.updated'));
    }

    public function destroy(Media $media): RedirectResponse
    {
        $this->documents->delete($media);

        return back()->with('success', __('app.messages.deleted'));
    }
}
