<?php

namespace Hjolfaei\Todo\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => (string)$this->id,
            'user_id' => (string)$this->user_id,
            'type' => 'Tasks',
            'title' => $this->title,
            'status' => (string)$this->status,
            'task_labels' => (empty($this->LABELS) ? '0' : $this->LABELS ),
            'description' => $this->description,
            //'created_at' => $this->created_at,
            //'updated_at' => $this->updated_at

        ];
    }
}
