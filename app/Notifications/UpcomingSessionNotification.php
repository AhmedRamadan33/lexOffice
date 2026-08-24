<?php

namespace App\Notifications;

use App\Models\CaseSession;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UpcomingSessionNotification extends Notification
{
    use Queueable;

    public function __construct(public CaseSession $session)
    {
    }

    public function via($notifiable): array
    {
        return ['database'];
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
