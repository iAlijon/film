<?php

namespace App\Http\Resources;

use App\Traits\GetLang;
use Illuminate\Http\Resources\Json\JsonResource;

class CalendarResource extends JsonResource
{
    use GetLang;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lang = $request->header('lang', 'oz');
        return [
          'id' => $this->id,
          'aphorism_id' => $this->aphorism_id,
          'description' => $this->getTranslates('description', $lang),
        ];
    }
}
