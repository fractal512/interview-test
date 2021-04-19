<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = Role::where('slug','client')->first();
        $manager = Role::where('slug', 'manager')->first();
        $createRequests = Permission::where('slug','create-requests')->first();
        $manageRequests = Permission::where('slug','manage-requsts')->first();

        $user1 = new User();
        $user1->name = 'Manager';
        $user1->email = 'manager@example.com';
        $user1->password = bcrypt('12345678');
        $user1->save();
        $user1->roles()->attach($manager);
        $user1->permissions()->attach($manageRequests);

        $user2 = new User();
        $user2->name = 'Client';
        $user2->email = 'client@example.com';
        $user2->password = bcrypt('12345678');
        $user2->save();
        $user2->roles()->attach($client);
        $user2->permissions()->attach($createRequests);
    }
}
