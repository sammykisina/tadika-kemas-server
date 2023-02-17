<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Requests\Admin\EventRequest;
use App\Http\Resources\Admin\EventResource;
use Domains\Admin\Models\Event;
use Domains\Admin\Services\EventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use JustSteveKing\StatusCode\Http;

class EventController {
    public function __construct(
        protected EventService $service
    ) {
    }

    public function index(): JsonResponse {
        return response()->json(
            data: EventResource::collection(
                resource: $this->service->getAllEvents()
            ),
            status: Http::OK()
        );
    }

    public function store(EventRequest $request): JsonResponse {
        try {
            $this->service->sendEventNotification(
                event: $this->service->createEvent(eventCreateData: $request->validated())
            );

            return response()->json(
                data: [
                    'error' => 0,
                    'message' => "Event created successfully."
                ],
                status: Http::ACCEPTED()
            );
        } catch (\Throwable $th) {
            Log::info($th);

            return response()->json(
                data: [
                    'error' => 1,
                    'message' => "Something went wrong.Event not created."
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }

    public function update(EventRequest $request, Event $event): JsonResponse {
        try {
            $this->service->updateEvent(eventUpdateData: $request->validated(), event: $event);

            /**
             * TODO: Created a new notification
             */

            return response()->json(
                data: [
                    'error' => 0,
                    'message' => "Event updated successfully."
                ],
                status: Http::ACCEPTED()
            );
        } catch (\Throwable $th) {
            Log::info($th);

            return response()->json(
                data: [
                    'error' => 1,
                    'message' => "Something went wrong.Event not created."
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }

    public function destroy(Event $event): JsonResponse {
        try {
            $this->service->deleteEvent(event: $event);

            return response()->json(
                data: [
                    'error' => 0,
                    'message' => "Event deleted successfully."
                ],
                status: Http::ACCEPTED()
            );
        } catch (\Throwable $th) {
            Log::info($th);

            return response()->json(
                data: [
                    'error' => 1,
                    'message' => "Something went wrong.Event not created."
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
