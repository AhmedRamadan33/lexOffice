<?php

namespace App\Services;

use App\Models\Testimonial;
use App\Repositories\Contracts\TestimonialRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TestimonialService
{
    public function __construct(protected TestimonialRepositoryInterface $testimonials)
    {
    }

    public function paginate(array $filters): LengthAwarePaginator
    {
        return $this->testimonials->paginate($filters);
    }

    public function listActive(): Collection
    {
        return $this->testimonials->listActive();
    }

    public function create(array $data, Request $request): Testimonial
    {
        $testimonial = $this->testimonials->create($data);

        if ($request->hasFile('photo')) {
            $testimonial->addMediaFromRequest('photo')->toMediaCollection('photo');
        }

        return $testimonial;
    }

    public function update(Testimonial $testimonial, array $data, Request $request): Testimonial
    {
        $this->testimonials->update($testimonial, $data);

        if ($request->hasFile('photo')) {
            $testimonial->addMediaFromRequest('photo')->toMediaCollection('photo');
        }

        return $testimonial;
    }

    public function delete(Testimonial $testimonial): bool
    {
        return $this->testimonials->delete($testimonial);
    }
}
