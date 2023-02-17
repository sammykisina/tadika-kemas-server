<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StudentRegisterRequest extends FormRequest {
    public function rules(): array {
        return [
            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],
            'name' => [
                'required',
                'string'
            ],
            'password' => [
                'required',
                'string'
            ],
            'address' => [
                'required',
                'string'
            ],
            'fartherName' => [
                'required',
                'string'
            ],
            'fartherPhone' => [
                'required',
                'string'
            ],
            'motherName' => [
                'required',
                'string'
            ],
            'motherPhone' => [
                'required',
                'string'
            ],
            'studentRegId' => [
                'required',
                'string',
                'unique:users,reg_id'
            ],
            'studentCob' => [
                'required',
                'string'
            ],
            'selectedRace' => [
                'required',
                'string'
            ],
            'selectedClass' => [
                'required',
                'string'
            ],
            'dateOfBirth' => [
                'required',
                'string'
            ],
            'dateOfEnrollment' => [
                'required',
                'string'
            ]
        ];
    }

     public function studentRegistrationData(): array {
         return $this->validated();
     }
}
