<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $table = 'process';
    
    protected $fillable = ['title', 'order', 'application_id', 'description', 
        'message_pending', 'message_failure', 'message_success'];
    
    public function application() {
        return $this->belongsTo('App\Models\Application', 'application_id', 'id');
    }
}
