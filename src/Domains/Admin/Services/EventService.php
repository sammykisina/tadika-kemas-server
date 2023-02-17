<?php

declare(strict_types=1);

namespace Domains\Admin\Services;

use App\Notifications\Student\EventNotification;
use Domains\Admin\Models\Event;
use Domains\Shared\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;
use Spatie\QueryBuilder\QueryBuilder;

class EventService {
    public function getAllEvents(): Collection {
        return QueryBuilder::for(subject: Event::class)
            ->defaultSort('-created_at')
            ->get();
    }

    public function createEvent(array $eventCreateData): Event {
        return Event::create($eventCreateData);
    }

    public function updateEvent(array $eventUpdateData, Event $event): void {
        $event->update($eventUpdateData);
    }

    public function deleteEvent(Event $event): void {
        $event->delete();
    }

    public function sendEventNotification(Event $event): void {
        $students = User::query()->where('reg_id', "!=", null)->get();

        Notification::send($students, new EventNotification(event: $event));
    }
}
