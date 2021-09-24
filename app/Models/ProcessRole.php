<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessRole extends Model
{
    protected $table = 'process_roles';
    
    protected $fillable = [
        'role_id',
        'process_id',
        'read',
        'create',
        'update',
        'delete'
    ];

    public function process() {
        return $this->belongsTo('App\Models\Process', 'process', 'id');
    }

    public function role() {
        return $this->belongsTo('App\Models\Role', 'role_id', 'id');
    }
}
