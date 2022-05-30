<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            // Create users
            $user1 = User::create([ // Admin
                'name' => 'Admin RM',
                'email' => 'dev@ucan.be',
                'password' => Hash::make('12345678')
            ]);

            $user2 = User::create([ // User Manager
                'name' => 'Manager John',
                'email' => 'manager.john@gmail.com',
                'password' => Hash::make('12345678')
            ]);

            $user3 = User::create([ // Trainer
                'name' => 'Trainer Merwy',
                'email' => 'trainer.merwy@gmail.com',
                'password' => Hash::make('12345678')
            ]);

            $user4 = User::create([ // User
                'name' => 'User Perk',
                'email' => 'perk@gmail.com',
                'password' => Hash::make('12345678')
            ]);

            $user5 = User::create([ // User
                'name' => 'User Cristina',
                'email' => 'cris@gmail.com',
                'password' => Hash::make('12345678'),
                // 'access_code' => strtoupper(Str::random(6))
            ]);
            
            // Create profiles
            DB::table('profiles')->insert([
                [
                    'user_id' => $user1->id,
                    'company_name' => 'Be Happy',
                    'first_name' => "Admin",
                    'last_name' => "RM"
                ],
                [
                    'user_id' => $user2->id,
                    'company_name' => 'Be Useful',
                    'first_name' => "Manager",
                    'last_name' => "John"
                ],
                [
                    'user_id' => $user3->id,
                    'company_name' => 'Be Practical',
                    'first_name' => "Trainer",
                    'last_name' => "Merwy"
                ],
                [
                    'user_id' => $user4->id,
                    'company_name' => 'Be Realistic',
                    'first_name' => "User",
                    'last_name' => "Perk"
                ],
                [
                    'user_id' => $user5->id,
                    'company_name' => 'Be Efficient',
                    'first_name' => "User",
                    'last_name' => "Cristina"
                ]
            ]);

            // sync roles & permissions
            $user1->assignRole('Admin');
            $user2->assignRole('User Manager');
            $user3->assignRole('Trainer');
            $user4->assignRole('User');
            $user5->assignRole('User');

            $user1->syncPermissions(['Manage users', 'Manage roles', 'Manage permissions', 'Manage activities']);
            $user2->syncPermissions(['Manage users', 'Manage activities']);
            $user3->syncPermissions(['Manage activities']);
            $user4->syncPermissions(['Manage activities']);
            $user5->syncPermissions(['Manage activities']);
        });
        
        // php artisan db:seed --class=UserSeeder
    }
}
