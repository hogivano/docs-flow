<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseAction extends Model
{
    protected $table = 'base_actions';

    protected $fillable = [
        'name',
        'type',
        'location',
        'validation',
        'min',
        'max'
    ];

    public $timestamps = false;

    public static function typeOption() {
        return [
            'text', 'file', 'number', 'boolean', 'datetime'
        ];
    }

    public function processAction() {
        return $this->hasMany('App\Models\ProcessAction', 'base_action_id', 'id');
    }
}
