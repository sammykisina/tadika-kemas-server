<?php

declare(strict_types=1);

namespace App\Http\Resources\Shared;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'type' => 'user',
            'attributes' => [
                'uuid' => $this->uuid,
                'regNumber' => $this->reg_id,
                'name' => $this->name,
                'email' => $this->email,
                'cob' => $this->cob ?? "",
                'race' => $this->race ?? "",
                'address' => $this->address ?? "",
                'class' => $this->class ?? "",
                'age' => $this->age ?? "",
                'fatherName' => $this->father_name ?? "",
                'fatherPhone' => $this->father_phone ?? "",
                'motherName' => $this->mother_name ?? "",
                'motherPhone' => $this->mother_phone ?? "",
                'dateOfBirth' => $this->date_of_birth ?? "",
                'enrollDate'=> $this->enroll_date ?? ""
            ]
        ];
    }
}
