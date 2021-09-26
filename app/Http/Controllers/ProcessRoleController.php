<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Models\Role;
use App\Models\ProcessRole;
use Illuminate\Http\Request;

class ProcessRoleController extends Controller
{
    //
    public static function generateByProcess($process_id) {
        $roles = Role::all();
        foreach ($roles as $role) {
            $default = ($role->id == 1) ? 1 : 0;
            ProcessRole::create([
                'role_id' => $role->id,
                'process_id' => $process_id,
                'read' => $default,
                'create' => $default,
                'update' => $default,
                'delete' => $default,
            ]);
        }
    }

    public static function generateByRole($role_id) {
        $process = Process::all();
        foreach ($process as $pro) {
            ProcessRole::create([
                'role_id' => $role_id,
                'process_id' => $pro->id,
                'read' => 0,
                'create' => 0,
                'update' => 0,
                'delete' => 0,
            ]);
        }
    }
}
