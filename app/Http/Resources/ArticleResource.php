<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
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
            'type' => 'Articles',
            'attributes' => [
                'title' => $this->title,
                'content' => $this->content,
                'user_id' => $this->user_id,
                'image' => $this->image,
                'created_at' => $this->created_at,
            ],
        ];
    }
}
