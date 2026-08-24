<?php

namespace App\Console\Commands;

use App\Models\CaseSession;
use App\Models\Task;
use App\Notifications\TaskDueNotification;
use App\Notifications\UpcomingSessionNotification;
use Illuminate\Console\Command;

class SendReminders extends Command
{
    protected $signature = 'app:send-reminders';

    protected $description = 'Notify lawyers about tomorrow\'s sessions and users about due tasks';

    public function handle(): void
    {
        $tomorrow = today()->addDay();

        $sessions = CaseSession::query()
            ->with('case.assignedLawyer', 'case.creator')
            ->whereDate('session_date', $tomorrow)
            ->where('status', 'scheduled')
            ->get();

        foreach ($sessions as $session) {
            $recipient = $session->case?->assignedLawyer ?? $session->case?->creator;
            $recipient?->notify(new UpcomingSessionNotification($session));
        }

        $tasks = Task::query()
            ->with('assignee')
            ->whereDate('due_date', $tomorrow)
            ->where('status', '!=', 'done')
            ->get();

        foreach ($tasks as $task) {
            $task->assignee?->notify(new TaskDueNotification($task));
        }

        $this->info(sprintf('Sent %d session and %d task reminders.', $sessions->count(), $tasks->count()));
    }
}
