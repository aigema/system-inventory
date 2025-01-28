<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $fillable = [
        'storage_id', 'name', 'code', 'category', 'image', 'description'
    ];

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

}
