<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
    use SoftDeletes;
    protected $table = 'submissions';

    protected $fillable = [
        'code', 'slug', 'title', 'description', 'application_id',
        'created_by', 'updated_by'
    ];

    public function application() {
        return $this->belongsTo('App\Models\Application', 'application_id', 'id');
    }

    public function createUser() {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function updateUser() {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }
}
