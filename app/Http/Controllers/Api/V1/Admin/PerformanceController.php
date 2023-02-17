<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Requests\Admin\StudentPerformanceRequest;
use App\Http\Resources\Admin\PerformanceResource;
use Domains\Admin\Models\Performance;
use Domains\Admin\Services\PerformanceService;
use Domains\Shared\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use JustSteveKing\StatusCode\Http;

class PerformanceController {
    public function __construct(
        protected PerformanceService $service
    ) {
    }

    public function index() {
        return response()->json(
            data: PerformanceResource::collection(
                resource: $this->service->getAllPerformances()
            ),
            status: Http::OK()
        );
    }

    public function createStudentPerformance(StudentPerformanceRequest $request, User $student): JsonResponse {
        try {
            if ($this->service->checkIfASimilarPerformanceExists(
                studentId: $student->id,
                type: $request->get(key: 'type'),
                period: $request->get(key: 'period'),
                year: $request->get(key: 'year'),
                subject: $request->get(key: 'subject'),
            )) {
                return response()->json(
                    data: [
                        'error' => 1,
                        'message' => "Such a performance exists!Search with the student id to edit."
                    ],
                    status: Http::NOT_IMPLEMENTED()
                );
            }

            $this->service->createPerformance(
                studentPerformanceData: array_merge(
                    $request->validated(),
                    [
                        'studentId' => $student->id,
                        'totalAwarding' => $this->service->getTotalAwarding($request->get(key: 'type')),
                        'status' => $this->service->getPerformanceStatus(
                            type: $request->get(key: 'type'),
                            marks: $request->get(key: 'marks')
                        )
                    ],
                )
            );

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
                    'message' => "Something went wrong. Student performance not created."
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }

    public function updateStudentPerformance(
        StudentPerformanceRequest $request,
        User $student,
        Performance $performance
    ): JsonResponse {
        try {
            $this->service->updatePerformance(
                studentUpdateData: array_merge(
                    $request->validated(),
                    [
                        'studentId' => $student->id,
                        'totalAwarding' => $this->service->getTotalAwarding($request->get(key: 'type')),
                        'status' => $this->service->getPerformanceStatus(
                            type: $request->get(key: 'type'),
                            marks: $request->get(key: 'marks')
                        )
                    ],
                ),
                performance: $performance
            );

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
                    'message' => "Something went wrong. Student performance not updated."
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
