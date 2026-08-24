<?php

namespace App\Http\Requests\TeamMember;

class UpdateTeamMemberRequest extends StoreTeamMemberRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'sort_order' => $this->input('sort_order', 0),
            'is_featured' => $this->boolean('is_featured'),
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}
