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
        return [
            'id' => $this->id,
            'images' => $this->images,
            'created_at' => $this->created_at,
            'full_name' => $this->translations->first()->full_name ?? null,
            'description' => $this->translations->first()->description ?? null,
            'translates' => $this->translations->first()->translates ?? null
        ];
    }
}
