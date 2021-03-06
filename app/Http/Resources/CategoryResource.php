<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\PostResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request); # Esto retorna todo los elemntos tal cual muestra el modelo

       return [
           'id' => $this->id,
           'name' => $this->name,
           'slug' => $this->slug,
           'posts' => PostResource::collection($this->whenLoaded('posts'))
       ];
    }
}
