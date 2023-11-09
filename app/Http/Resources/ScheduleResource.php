<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'student_id' => $this->student_id,
            'subject_id' => $this->subject_id,
            'schedule_date' => $this->schedule_date,
            'schedule_type' => $this->schedule_type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'subject' => [
                'id' => $this->subject->id,
                'title' => $this->subject->title,
                'lecturer_id' => [
                    'id' => $this->subject->lecturer->id,
                    'name' => $this->subject->lecturer->name,
                    'email' => $this->subject->lecturer->email,
                    'created_at' => $this->subject->lecturer->created_at,
                    'updated_at' => $this->subject->lecturer->updated_at,
                ],
                'created_at' => $this->subject->created_at,
                'updated_at' => $this->subject->updated_at,
            ],
        ];
    }
}
