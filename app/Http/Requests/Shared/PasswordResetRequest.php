<?php

declare(strict_types=1);

namespace App\Http\Requests\Shared;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest {
    public function rules(): array {
        return [
            'email' => [
                'required',
                'email',
                'exists:users,email'
            ],
            'password' => [
                'required',
                'string'
            ]
        ];
    }
}
