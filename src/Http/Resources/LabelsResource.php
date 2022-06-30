<?php

namespace Hjolfaei\Todo\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LabelsResource extends JsonResource
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
            'type' => 'Labels',
            'total_tasks' => (string)(empty($this->total_tasks) ? '0' : $this->total_tasks ),
            'name' => $this->name,
            //'created_at' => $this->created_at,
            //'updated_at' => $this->updated_at

        ];
    }
}
