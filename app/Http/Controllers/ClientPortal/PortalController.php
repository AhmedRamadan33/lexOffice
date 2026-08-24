<?php

namespace App\Http\Controllers\ClientPortal;

use App\Http\Controllers\Controller;
use App\Models\CaseModel;
use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PortalController extends Controller
{
    public function dashboard(): View
    {
        $client = $this->client();
        $caseIds = $this->caseIds($client);

        $stats = [
            'open_cases' => CaseModel::whereIn('id', $caseIds)->where('status', 'open')->count(),
            'upcoming_sessions' => \App\Models\CaseSession::whereIn('case_id', $caseIds)
                ->where('session_date', '>=', today())
                ->count(),
            'unpaid_invoices' => Invoice::where('client_id', $client->id)->whereIn('status', ['unpaid', 'partial'])->count(),
        ];

        $upcomingSessions = \App\Models\CaseSession::with('case')
            ->whereIn('case_id', $caseIds)
            ->where('session_date', '>=', today())
            ->orderBy('session_date')
            ->limit(5)
            ->get();

        return view('portal.dashboard', compact('stats', 'upcomingSessions'));
    }

    public function cases(): View
    {
        $client = $this->client();

        $cases = CaseModel::with(['court', 'caseType', 'assignedLawyer'])
            ->whereIn('id', $this->caseIds($client))
            ->orderByDesc('start_date')
            ->get();

        return view('portal.cases.index', compact('cases'));
    }

    public function caseShow(CaseModel $case): View
    {
        $client = $this->client();
        abort_unless($this->caseIds($client)->contains($case->id), 403);

        $case->load(['court', 'caseType', 'assignedLawyer', 'sessions' => fn ($q) => $q->orderByDesc('session_date')]);
        $documents = $case->media->filter(fn ($media) => $media->getCustomProperty('client_visible', false));

        return view('portal.cases.show', compact('case', 'documents'));
    }

    public function invoices(): View
    {
        $client = $this->client();

        $invoices = Invoice::where('client_id', $client->id)->orderByDesc('created_at')->get();

        return view('portal.invoices.index', compact('invoices'));
    }

    public function invoiceShow(Invoice $invoice): View
    {
        $client = $this->client();
        abort_unless($invoice->client_id === $client->id, 403);

        $invoice->load(['items', 'payments']);

        return view('portal.invoices.show', compact('invoice'));
    }

    public function documents(): View
    {
        $client = $this->client();

        $documents = $client->media->filter(fn ($media) => $media->getCustomProperty('client_visible', false))
            ->map(fn ($media) => ['media' => $media, 'source' => __('app.labels.client')]);

        $cases = CaseModel::with('media')->whereIn('id', $this->caseIds($client))->get();

        foreach ($cases as $case) {
            foreach ($case->media->filter(fn ($media) => $media->getCustomProperty('client_visible', false)) as $media) {
                $documents->push(['media' => $media, 'source' => $case->case_number]);
            }
        }

        return view('portal.documents.index', ['documents' => $documents->values()]);
    }

    public function profile(): View
    {
        return view('portal.profile');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $client = $this->client();

        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (! Hash::check($request->input('current_password'), $client->password)) {
            return back()->withErrors(['current_password' => __('app.portal.profile.current_password_invalid')]);
        }

        $client->update(['password' => $request->input('password')]);

        return back()->with('success', __('app.messages.updated'));
    }

    private function client(): Client
    {
        return Auth::guard('client')->user();
    }

    private function caseIds(Client $client): Collection
    {
        return $client->primaryCases()->pluck('cases.id')
            ->merge($client->cases()->pluck('cases.id'))
            ->unique()
            ->values();
    }
}
