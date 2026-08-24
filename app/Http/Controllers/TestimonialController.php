<?php

namespace App\Http\Controllers;

use App\Http\Requests\Testimonial\StoreTestimonialRequest;
use App\Http\Requests\Testimonial\UpdateTestimonialRequest;
use App\Models\Testimonial;
use App\Services\TestimonialService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function __construct(protected TestimonialService $testimonials)
    {
    }

    public function index(Request $request): View
    {
        $testimonials = $this->testimonials->paginate($request->only(['search', 'is_active', 'per_page']));

        return view('testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        return view('testimonials.create');
    }

    public function store(StoreTestimonialRequest $request): RedirectResponse
    {
        $this->testimonials->create($request->validated(), $request);

        return redirect()->route('testimonials.index')->with('success', __('app.messages.created'));
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('testimonials.edit', compact('testimonial'));
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial): RedirectResponse
    {
        $this->testimonials->update($testimonial, $request->validated(), $request);

        return redirect()->route('testimonials.index')->with('success', __('app.messages.updated'));
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $this->testimonials->delete($testimonial);

        return redirect()->route('testimonials.index')->with('success', __('app.messages.deleted'));
    }
}
