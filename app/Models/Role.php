<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'role'];
    public $timestamps = false;

    public function processRole() {
        return $this->hasMany('App\Models\ProcessRole', 'process_id', 'id');
    }
}
