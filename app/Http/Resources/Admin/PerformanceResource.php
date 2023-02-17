<?php

declare(strict_types=1);

namespace App\Http\Resources\Admin;

use App\Http\Resources\Shared\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PerformanceResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'type' => 'performance',
            'attributes' => [
                'uuid' => $this->uuid,
                'type' => $this->type,
                'totalAwarding' => $this->totalAwarding,
                'period' => $this->period,
                'year' => $this->year,
                'subject' => $this->subject,
                'marks' => $this->marks,
                'status' => $this->status,
                'comment' => $this->comment,

            ],
            'relationships' => [
                'student' => new UserResource(
                    resource: $this->whenLoaded(
                        relationship: 'student'
                    )
                )
            ]
        ];
    }
}
