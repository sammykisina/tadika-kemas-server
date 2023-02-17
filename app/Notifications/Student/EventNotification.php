<?php

declare(strict_types=1);

namespace App\Notifications\Student;

use Domains\Admin\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class EventNotification extends Notification {
    use Queueable;

    public function __construct(
        public Event $event
    ) {
    }

    public function via($notifiable): array {
        return ['database'];
    }

    public function toArray($notifiable): array {
        return [
            'event' => [
                'name' => $this->event->name,
                'purpose' => $this->event->purpose,
                'date' => $this->event->date,
                'time' => $this->event->time
            ]
        ];
    }
}
