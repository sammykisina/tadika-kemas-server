<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => [
                'required',
                'string'
            ],
            'purpose' => [
                'required',
                'string'
            ],
            'date' => [
                'required',
                'string'
            ],
            'time' => [
                'required', 
                'string'
            ]
        ];
    }
}
