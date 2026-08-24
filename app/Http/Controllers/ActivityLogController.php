<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    public function __construct(protected ActivityLogService $logs)
    {
    }

    public function index(Request $request): View
    {
        $logs = $this->logs->paginate($request->only(['search', 'event', 'subject_type', 'branch_id', 'per_page']));
        $subjectOptions = $this->logs->subjectOptions();
        $branches = auth()->user()->can('view-all-branches')
            ? Branch::orderBy('name->ar')->get()
            : collect();

        return view('activity-log.index', compact('logs', 'subjectOptions', 'branches'));
    }
}
