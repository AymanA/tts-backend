<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "review-count"      => $this->review_count,
            "average-score"     => $this->average_score,
            "date-group"         => $this->date_group,
        ];

    }
}
