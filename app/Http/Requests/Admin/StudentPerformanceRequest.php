<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StudentPerformanceRequest extends FormRequest {
    public function rules(): array {
        return [
            'period' => [
                'required',
                'string'
            ],
            'year' => [
                'required',
                'integer'
            ],
            'subject' => [
                'required',
                'string'
            ],
            'marks' => [
                'required',
                'integer'
            ],
            'comment' => [
                'required',
                'string'
            ],
            'type' => [
                'required',
                'string'
            ]
        ];
    }
}
