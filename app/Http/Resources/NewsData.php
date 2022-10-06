<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsData extends JsonResource
{
    public function toArray($request)
    {
        return [
            'headline' => $this->title,
            'link'     => $this->link,
        ];
    }
}
