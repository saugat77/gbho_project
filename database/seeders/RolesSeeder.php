<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create role
        foreach (config('authorization.roles') as $role) {
            $this->command->getOutput()->write("<comment>Creating role: </comment>");
            $this->command->getOutput()->writeln($role);
            ${$role} = Role::firstOrCreate(['name' => $role]);
        }

        // create users and assign roles
        $this->command->comment("<comment>+----------------+</comment>");
        $this->command->comment("| Creating Users |");
        $this->command->comment("<comment>+----------------+</comment>");
        $headers = ['name', 'email', 'password', 'role'];

        $content = [];

        foreach (config('authorization.users') as $user) {
            // $newUser = User::whereEmail($user['email'])->first() ??  new User();
            $newUser = User::firstOrCreate(
                [
                    'email' => $user['email']
                ],
                [
                    'name' => 'James Bhatta',
                    'password' => bcrypt('password'),
                    'email_verified_at' => now(),
                    'remember_token' => Str::random(10),
                ]
            );
            $action = 'created';
            // $action = 'updated';

            // Assign roles to user
            $newUser->syncRoles($user['roles']);

            // Push user to console table
            array_push($content, [$user['name'], $user['email'], $user['password'], implode('|', $user['roles']), $action]);
        }

        $this->command->table($headers, $content);
    }
}
