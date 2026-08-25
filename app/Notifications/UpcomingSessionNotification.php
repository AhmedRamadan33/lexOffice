<?php

namespace App\Notifications;

use App\Models\CaseSession;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpcomingSessionNotification extends Notification
{
    use Queueable;

    public function __construct(public CaseSession $session)
    {
    }

    public function via($notifiable): array
    {
        return $notifiable->email ? ['database', 'mail'] : ['database'];
    }

    public function toMail($notifiable): MailMessage
    {
        $case = $this->session->case;

        return (new MailMessage)
            ->subject(__('app.notifications.mail.upcoming_session_subject', ['case_number' => $case?->case_number]))
            ->greeting(__('app.notifications.mail.greeting', ['name' => $notifiable->name]))
            ->line(__('app.notifications.upcoming_session', ['case_number' => $case?->case_number]))
            ->line(__('app.notifications.mail.session_date', ['date' => $this->session->session_date?->format('Y-m-d')]))
            ->action(__('app.notifications.mail.view_case'), route('cases.show', $case))
            ->line(__('app.notifications.mail.footer'));
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'session',
            'case_id' => $this->session->case_id,
            'case_number' => $this->session->case?->case_number,
            'session_date' => $this->session->session_date?->format('Y-m-d'),
            'message_key' => 'app.notifications.upcoming_session',
        ];
    }
}
