<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcessAction extends Model
{
    use SoftDeletes;
    protected $table = 'process_actions';

    protected $fillable = [
        'title',
        'description',
        'label_input',
        'is_required',
        'process_show',
        'related_process_action_id',
        'base_action_id',
        'message_pending',
        'message_failure',
        'message_success',
        'process_id',
    ];

    public function processActionUser() {
        return $this->hasMany('App\Models\ProcessActionUser', 'process_action_id', 'id');
    }

    public function baseAction() {
        return $this->belongsTo('App\Models\BaseAction', 'base_action_id', 'id');
    }

    public function process() {
        return $this->belongsTo('App\Models\Process', 'process_id', 'id');
    }

    public function parentRelatedAction() {
        return $this->belongsTo('App\Models\ProcessAction', 'related_process_action_id', 'id');
    }

    public function childRelatedAction() {
        return $this->hasMany('App\Models\ProcessAction', 'related_process_action_id', 'id');
    }
}
