<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = config('roles.models.role')::where('name', '=', 'User')->first();
        $adminRole = config('roles.models.role')::where('name', '=', 'Admin')->first();
        $permissions = config('roles.models.permission')::all();

        /*
         * Add Admin User
         */
        if (config('atlas.initialUsers.admin.user01Enabled')) {
            if (config('roles.models.defaultUser')::where('email', '=', config('atlas.initialUsers.admin.user01Email'))->first() == null) {

                $newAdminUser = config('roles.models.defaultUser')::create([
                    'firstname' => config('atlas.initialUsers.admin.user01FirstName'),
                    'lastname'  => config('atlas.initialUsers.admin.user01FirstName'),
                    'email'     => config('atlas.initialUsers.admin.user01Email'),
                    'password'  => Hash::make(config('atlas.initialUsers.admin.user01PW')),
                ]);

                $newAdminUser->attachRole($adminRole);

                foreach ($permissions as $permission) {
                    $newAdminUser->attachPermission($permission);
                }
            }
        }

        /*
         * Add Registered User
         */
        if (config('atlas.initialUsers.registered.user01Enabled')) {
            if (config('roles.models.defaultUser')::where('email', '=', config('atlas.initialUsers.registered.user01Email'))->first() == null) {

                $newUser = config('roles.models.defaultUser')::create([
                    'firstname' => config('atlas.initialUsers.registered.user01FirstName'),
                    'lastname'  => config('atlas.initialUsers.registered.user01FirstName'),
                    'email'     => config('atlas.initialUsers.registered.user01Email'),
                    'password'  => Hash::make(config('atlas.initialUsers.registered.user01PW')),
                ]);

                $newUser->attachRole($userRole);
            }
        }
    }
}
