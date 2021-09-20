<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $new = new Role();
        $new->role = 'su';
        $new->name = 'Super Admin';
        $new->save();
    }
}
