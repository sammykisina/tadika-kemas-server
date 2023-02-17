<?php

declare(strict_types=1);

namespace Domains\Admin\Services;

use Domains\Admin\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class EventService {
    public function getAllEvents(): Collection {
        return QueryBuilder::for(subject: Event::class)
            ->defaultSort('-created_at')
            ->get();
    }

    public function createEvent(array $eventCreateData): void {
      Event::create($eventCreateData);
    }

    public function updateEvent(array $eventUpdateData, Event $event): void {
      $event->update($eventUpdateData);
    }

    public function deleteEvent(Event $event): void {
      $event->delete();
    }
}
