<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manageUser = new Permission();
        $manageUser->name = 'Manage Requests';
        $manageUser->slug = 'manage-requests';
        $manageUser->save();

        $createTasks = new Permission();
        $createTasks->name = 'Create Requests';
        $createTasks->slug = 'create-requests';
        $createTasks->save();
    }
}
