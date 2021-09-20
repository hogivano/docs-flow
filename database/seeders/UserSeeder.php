<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $new = new User();
        $new->name = 'Super Admin';
        $new->email = 'admin@admin.com';
        $new->password = Hash::make('testing');
        $new->save();

        UserRole::create([
            'user_id' => $new->id,
            'role_id' => 1,
        ]);
    }
}
