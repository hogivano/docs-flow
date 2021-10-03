<?php

namespace App\Models;

use App\Model\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionCreated extends Model
{
    protected $table = 'submission_created';

    protected $fillable = [
        'role_id'
    ];

    public function role() {
        return $this->belongsTo('App\Models\Role', 'role_id', 'id');
    }
}
