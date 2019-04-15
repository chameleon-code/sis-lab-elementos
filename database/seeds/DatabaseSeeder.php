<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('users');
        
        Storage::makeDirectory('users');

        factory(\App\Role::class, 1)->create(['name' => 'admin']);
        factory(\App\Role::class, 1)->create(['name' => 'professor']);
        factory(\App\Role::class, 1)->create(['name' => 'auxiliar']);
        factory(\App\Role::class, 1)->create(['name' => 'student']);
        
        factory(\App\User::class, 1)->create([
            'names' => 'admin',
            'first_name' => 'admin',
            'second_name' => 'admin',
            'email'=>'admin@admin.com',
            'password' => bcrypt('secret'),
            'role_id' => \App\Role::ADMIN
        ])
        ->
        each(function (\App\User $u){
            factory(\App\Admin::class, 1)->create(['user_id' => $u->id]);
        });

        factory(\App\User::class, 5)->create([ 'role_id' => \App\Role::PROFESSOR ])
        ->each(function (\App\User $u){
            factory(\App\Professor::class, 1)->create(['user_id' => $u->id]);
        });

        factory(\App\User::class, 5)->create([ 'role_id' => \App\Role::AUXILIAR ])
        ->each(function (\App\User $u){
            factory(\App\Auxiliar::class, 1)->create(['user_id' => $u->id]);
        });

        factory(\App\User::class, 5)->create([ 'role_id' => \App\Role::STUDENT ])
        ->each(function (\App\User $u){
            factory(\App\Student::class, 1)->create(['user_id' => $u->id]);
        });
    }
}
