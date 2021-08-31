<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'category' => $this->category->name,
            'categoryId' => $this->category->id,
            'description' => $this->description,
            'published' => $this->created_at->format('d F, Y'),
            'link' => route('posts.show', [$this->slug])
        ];
    }
}
