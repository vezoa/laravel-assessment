<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TourResource extends JsonResource
{
    /**
     * We are using resource that choose
     * what exactly our API return to user
     *
     */
    public function toArray($request)
    {
        return [
            'start' =>Carbon::parse($this->start)->format('d/m/Y'),
            'end' =>Carbon::parse($this->end)->format('d/m/Y'),
            'price' =>$this->price

        ];
    }
}
