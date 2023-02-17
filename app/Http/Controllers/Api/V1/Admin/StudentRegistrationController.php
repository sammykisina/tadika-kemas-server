<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Requests\Admin\StudentRegisterRequest;
use App\Http\Resources\Shared\UserResource;
use Domains\Shared\Models\User;
use Domains\Shared\Services\StudentRegistrationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use JustSteveKing\StatusCode\Http;

class StudentRegistrationController {
    public function __construct(
        protected StudentRegistrationService $service
    ) {
    }

    public function index(): JsonResponse {
        return response()->json(
            data: UserResource::collection(resource: $this->service->getAllStudents()),
            status: Http::OK()
        );
    }

    public function store(StudentRegisterRequest $request): JsonResponse {
        try {
            $this->service->create(request: $request);
            return response()->json(
                data: [
                    'error' => 0,
                    'message' => "Student created successfully."
                ],
                status: Http::CREATED()
            );
        } catch (\Throwable $th) {
            Log::info($th);

            return response()->json(
                data: [
                    'error' => 1,
                    'message' => "Something went wrong. Student not created."
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }

    public function update(Request $request, User $student): JsonResponse {
        try {
            $validated = $request->validate([
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users', 'email')->ignore(id: $student->id),
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
                    Rule::unique(table: 'users', column: 'reg_id')->ignore(id: $student->id),
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
            ]);

            $this->service->updateStudent(validated: $validated, student: $student);
            return response()->json(
                data: [
                    'error' => 0,
                    'message' => "Student updated successfully."
                ],
                status: Http::ACCEPTED()
            );
        } catch (\Throwable $th) {
            Log::info($th);

            return response()->json(
                data: [
                    'error' => 1,
                    'message' => "Something went wrong. Student not updated."
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }

    public function destroy(User $student): JsonResponse {
        try {
            $this->service->deleteStudent(student: $student);
            return response()->json(
                data: [
                    'error' => 0,
                    'message' => "Student deleted successfully."
                ],
                status: Http::ACCEPTED()
            );
        } catch (\Throwable $th) {
            Log::info($th);

            return response()->json(
                data: [
                    'error' => 1,
                    'message' => "Something went wrong. Student not deleted."
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
