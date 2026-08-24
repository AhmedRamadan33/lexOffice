<?php

namespace App\Http\Controllers;

use App\Http\Requests\Public\StoreContactMessageRequest;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\SuccessStory;
use App\Services\ContactMessageService;
use App\Services\PracticeAreaService;
use App\Services\SuccessStoryService;
use App\Services\TeamMemberService;
use App\Services\TestimonialService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function __construct(
        protected PracticeAreaService $practiceAreas,
        protected TeamMemberService $teamMembers,
        protected TestimonialService $testimonials,
        protected SuccessStoryService $stories,
        protected ContactMessageService $messages,
    ) {
    }

    public function home(): View
    {
        return view('public.home', [
            'setting' => SiteSetting::current(),
            'practiceAreas' => $this->practiceAreas->listActive()->take(6),
            'teamMembers' => $this->teamMembers->listActive()->where('is_featured', true)->take(4),
            'testimonials' => $this->testimonials->listActive(),
            'stories' => $this->stories->listActive()->take(3),
        ]);
    }

    public function about(): View
    {
        return view('public.about', [
            'setting' => SiteSetting::current(),
        ]);
    }

    public function services(): View
    {
        return view('public.services', [
            'setting' => SiteSetting::current(),
            'practiceAreas' => $this->practiceAreas->listActive(),
        ]);
    }

    public function lawyers(Request $request): View
    {
        $category = $request->query('category');
        $teamMembers = $this->teamMembers->listActive();

        if ($category) {
            $teamMembers = $teamMembers->where('category', $category);
        }

        return view('public.lawyers.index', [
            'setting' => SiteSetting::current(),
            'teamMembers' => $teamMembers,
            'categories' => $this->teamMembers->listActive()->pluck('category')->filter()->unique()->values(),
            'activeCategory' => $category,
        ]);
    }

    public function lawyerShow(TeamMember $teamMember): View
    {
        return view('public.lawyers.show', [
            'setting' => SiteSetting::current(),
            'teamMember' => $teamMember,
        ]);
    }

    public function stories(): View
    {
        return view('public.stories.index', [
            'setting' => SiteSetting::current(),
            'stories' => $this->stories->listActive(),
        ]);
    }

    public function storyShow(SuccessStory $story): View
    {
        return view('public.stories.show', [
            'setting' => SiteSetting::current(),
            'story' => $story,
        ]);
    }

    public function contact(): View
    {
        return view('public.contact', [
            'setting' => SiteSetting::current(),
        ]);
    }

    public function contactStore(StoreContactMessageRequest $request): RedirectResponse
    {
        $this->messages->submit($request->validated());

        return back()->with('success', __('app.public.contact.thanks'));
    }
}
