<?php

declare(strict_types=1);

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'type' => 'event',
            'attributes' => [
                'uuid' => $this->uuid,
                'name' => $this->name,
                'purpose' => $this->purpose,
                'date' => $this->date,
                'time' => $this->time
            ]
        ];
    }
}
