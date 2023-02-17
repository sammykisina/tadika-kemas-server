<?php

declare(strict_types=1);

namespace App\Http\Resources\Student;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentNotificationResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'type' => 'student notification',
            'attributes' => [
                'name' => $this->data['event']['name'],
                'purpose' => $this->data['event']['purpose'],
                'date' => $this->data['event']['date'],
                'time' => $this->data['event']['time'],
                'createdAt' => $this->created_at
            ]
        ];
    }
}
