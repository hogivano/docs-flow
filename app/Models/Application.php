<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug', 'title', 'description', 'is_ordered', 'created_at', 'updated_at'
    ];

    public function process() {
        $this->hasMany('App\Models\Process', 'application_id', 'id');
    }
}
