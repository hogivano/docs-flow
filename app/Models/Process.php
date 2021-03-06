<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Process extends Model
{
    use SoftDeletes;
    
    protected $table = 'process';
    
    protected $fillable = ['title', 'order', 'application_id', 'description', 
        'message_pending', 'message_failure', 'message_success'];
    
    public function application() {
        return $this->belongsTo('App\Models\Application', 'application_id', 'id');
    }
    
    public function processAction() {
        return $this->hasMany('App\Models\ProcessAction', 'process_id', 'id');
    }
}
