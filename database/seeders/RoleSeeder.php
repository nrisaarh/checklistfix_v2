<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id'         => 1,
                'name'       => 'admin',
            ],
            [
                'id'         => 2,
                'name'       => 'user',
            ],
        ]);
    }
}
