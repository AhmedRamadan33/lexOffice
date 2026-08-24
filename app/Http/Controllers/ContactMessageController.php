<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Services\ContactMessageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function __construct(protected ContactMessageService $messages)
    {
    }

    public function index(Request $request): View
    {
        $messages = $this->messages->paginate($request->only(['search', 'is_read', 'per_page']));

        return view('contact-messages.index', compact('messages'));
    }

    public function markRead(ContactMessage $contactMessage): RedirectResponse
    {
        $this->messages->markRead($contactMessage);

        return back()->with('success', __('app.messages.updated'));
    }

    public function destroy(ContactMessage $contactMessage): RedirectResponse
    {
        $this->messages->delete($contactMessage);

        return redirect()->route('contact-messages.index')->with('success', __('app.messages.deleted'));
    }
}
