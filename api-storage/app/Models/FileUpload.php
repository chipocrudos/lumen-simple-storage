<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class FileUpload extends Model
{
    protected $table = 'fileupload';

    protected static function boot()
    {
        parent::boot();
     
        // Order by name ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('related_id', 'asc')->orderBy('name', 'asc');
        });
    }

    protected $fillable = [
        'name', 'url', 'related_id'
    ];

}