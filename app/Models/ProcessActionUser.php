<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcessActionUser extends Model
{
    use SoftDeletes;

    protected $table = 'process_action_users';

    protected $fillable = [
        'submission_id',
        'user_id',
        'process_action_id',
        'value',
        'is_done',
        'created_by',
        'updated_by',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function createdBy() {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function updatedBy() {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }
}
