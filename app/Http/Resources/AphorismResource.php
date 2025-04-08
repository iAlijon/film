<?php

namespace App\Http\Resources;

use App\Models\Calendar;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\GetLang;
class AphorismResource extends JsonResource
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
            'full_name' => $this->getTranslates("full_name", $lang),
            'images' => $this->images,
            'description' => $this->getTranslates("description", $lang),
            'created_at' => $this->created_at,
            'calendar' => CalendarResource::collection($this->calendar),


        ];
    }
}
