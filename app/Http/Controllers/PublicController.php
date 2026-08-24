<?php

namespace App\Http\Controllers;

use App\Http\Requests\Public\StoreContactMessageRequest;
use App\Models\SiteSetting;
use App\Models\SuccessStory;
use App\Models\User;
use App\Services\ContactMessageService;
use App\Services\PracticeAreaService;
use App\Services\SuccessStoryService;
use App\Services\TestimonialService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    private const TEAM_CATEGORIES = ['partners', 'lawyers', 'admin_staff'];

    public function __construct(
        protected PracticeAreaService $practiceAreas,
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
            'teamMembers' => User::where('is_team_visible', true)->orderBy('sort_order')->take(4)->get(),
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

    public function team(Request $request): View
    {
        $activeCategory = $request->query('category');

        $grouped = User::where('is_team_visible', true)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');

        $availableCategories = collect(self::TEAM_CATEGORIES)->filter(fn ($cat) => $grouped->has($cat))->values();

        $sections = $availableCategories
            ->when($activeCategory, fn ($cats) => $cats->filter(fn ($cat) => $cat === $activeCategory))
            ->map(fn ($cat) => [
                'key' => $cat,
                'label' => __('app.public.team.categories.'.$cat),
                'members' => $grouped->get($cat),
            ]);

        return view('public.team.index', [
            'setting' => SiteSetting::current(),
            'sections' => $sections,
            'availableCategories' => $availableCategories,
            'activeCategory' => $activeCategory,
        ]);
    }

    public function teamShow(User $user): View
    {
        abort_unless($user->is_team_visible, 404);

        return view('public.team.show', [
            'setting' => SiteSetting::current(),
            'member' => $user,
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
