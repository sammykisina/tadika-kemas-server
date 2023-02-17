<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Shared;

use App\Http\Requests\Shared\PasswordResetRequest;
use App\Http\Requests\Shared\ProfileRequest;
use App\Http\Resources\Shared\UserResource;
use Domains\Shared\Services\ProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use JustSteveKing\StatusCode\Http;

class ProfileController {
    public function __construct(
        protected ProfileService $service
    ) {
    }

    public function getProfile(ProfileRequest $request): JsonResponse {
        return response()->json(
            data: new UserResource(
                resource: $this->service->getAllProfileData(email: $request->get(key: 'email'))
            ),
            status: Http::OK()
        );
    }

    public function resetPassword(PasswordResetRequest $request) {
        try {
            $this->service->changePassword(
               data: $request->validated()
            );

            return response()->json(
                data: [
                    'error' => 0,
                    'message' => "Password updated successfully."
                ],
                status: Http::ACCEPTED()
            );
        } catch (\Throwable $th) {
            Log::info($th);

            return response()->json(
                data: [
                    'error' => 1,
                    'message' => "Something went wrong.Password Not Updated."
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
