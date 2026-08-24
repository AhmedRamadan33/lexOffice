<?php

namespace App\Http\Controllers;

use App\Models\CaseModel;
use App\Models\CaseSession;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $user = Auth::user();

        $stats = [
            'open_cases' => $user->can('manage-cases') ? CaseModel::where('status', 'open')->count() : 0,
            'total_clients' => $user->can('manage-clients') ? Client::count() : 0,
            'today_sessions' => $user->can('manage-cases') ? CaseSession::whereDate('session_date', today())->count() : 0,
            'unpaid_invoices' => $user->can('manage-invoices') ? Invoice::whereIn('status', ['unpaid', 'partial'])->count() : 0,
            'overdue_tasks' => $user->can('manage-tasks') ? Task::where('status', '!=', 'done')->whereDate('due_date', '<', today())->count() : 0,
        ];

        $upcomingSessions = $user->can('manage-cases')
            ? CaseSession::with(['case.client'])
                ->where('session_date', '>=', today())
                ->where('status', 'scheduled')
                ->orderBy('session_date')
                ->limit(8)
                ->get()
            : collect();

        $myTasks = $user->can('manage-tasks')
            ? Task::with('case')->where('assigned_to', $user->id)->where('status', '!=', 'done')
                ->orderBy('due_date')
                ->limit(8)
                ->get()
            : collect();

        return view('dashboard', compact('stats', 'upcomingSessions', 'myTasks'));
    }
}
