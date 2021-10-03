<?php

namespace Database\Seeders;

use App\Models\SubmissionCreated;
use Illuminate\Database\Seeder;

class SubmissionCreatedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $new = new SubmissionCreated();
        $new->role_id = 1;
        $new->save();
    }
}
