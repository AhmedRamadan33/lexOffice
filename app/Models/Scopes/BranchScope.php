<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class BranchScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        if (auth()->check() && auth()->user()->branch_id && ! auth()->user()->can('view-all-branches')) {
            $builder->where($model->getTable().'.branch_id', auth()->user()->branch_id);
        }
    }
}
