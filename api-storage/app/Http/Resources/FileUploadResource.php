<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class FileUploadResource extends JsonResource
{

    public function toArray($request)
    {

        $app_url = config('app.url');

        return [

            'id'=> $this->id,
            'created_at'=> $this-> created_at,
            'updated_at'=> $this-> updated_at,
            'name'=> $this->name,
            'url'=> $this->url,
            'related_id'=> $this->related_id,
            'src'=> $app_url . $this->url
        ];
    }

}