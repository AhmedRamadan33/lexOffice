<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskDueNotification extends Notification
{
    use Queueable;

    public function __construct(public Task $task)
    {
    }

    public function via($notifiable): array
    {
        return $notifiable->email ? ['database', 'mail'] : ['database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('app.notifications.mail.task_due_subject', ['title' => $this->task->title]))
            ->greeting(__('app.notifications.mail.greeting', ['name' => $notifiable->name]))
            ->line(__('app.notifications.task_due', ['title' => $this->task->title]))
            ->line(__('app.notifications.mail.due_date', ['date' => $this->task->due_date?->format('Y-m-d')]))
            ->action(__('app.notifications.mail.view_task'), route('tasks.edit', $this->task))
            ->line(__('app.notifications.mail.footer'));
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'task',
            'task_id' => $this->task->id,
            'title' => $this->task->title,
            'due_date' => $this->task->due_date?->format('Y-m-d'),
            'message_key' => 'app.notifications.task_due',
        ];
    }
}
