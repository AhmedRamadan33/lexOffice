<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamMember\StoreTeamMemberRequest;
use App\Http\Requests\TeamMember\UpdateTeamMemberRequest;
use App\Models\TeamMember;
use App\Services\TeamMemberService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamMemberController extends Controller
{
    public function __construct(protected TeamMemberService $teamMembers)
    {
    }

    public function index(Request $request): View
    {
        $teamMembers = $this->teamMembers->paginate($request->only(['search', 'category', 'is_active', 'per_page']));

        return view('team-members.index', compact('teamMembers'));
    }

    public function create(): View
    {
        return view('team-members.create');
    }

    public function store(StoreTeamMemberRequest $request): RedirectResponse
    {
        $this->teamMembers->create($request->validated(), $request);

        return redirect()->route('team-members.index')->with('success', __('app.messages.created'));
    }

    public function edit(TeamMember $teamMember): View
    {
        return view('team-members.edit', compact('teamMember'));
    }

    public function update(UpdateTeamMemberRequest $request, TeamMember $teamMember): RedirectResponse
    {
        $this->teamMembers->update($teamMember, $request->validated(), $request);

        return redirect()->route('team-members.index')->with('success', __('app.messages.updated'));
    }

    public function destroy(TeamMember $teamMember): RedirectResponse
    {
        $this->teamMembers->delete($teamMember);

        return redirect()->route('team-members.index')->with('success', __('app.messages.deleted'));
    }
}
