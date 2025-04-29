<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            // 'start_time' => $this->start_time,
            // 'end_time' => $this->end_time,
            // 'user_id' => $this->user_id,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
            'user' => new UserResource($this->whenLoaded('user')), // Because it is a single item in array,
            'attendees' => AttendeeResource::collection($this->whenLoaded('attendees')), // Because it is a collection of items in array,
        ];
    }
}
