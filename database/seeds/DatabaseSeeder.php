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

        Storage::deleteDirectory('folders');
        Storage::makeDirectory('folders');

        factory(\App\Role::class, 1)->create(['name' => 'admin']);
        factory(\App\Role::class, 1)->create(['name' => 'professor']);
        factory(\App\Role::class, 1)->create(['name' => 'auxiliar']);
        factory(\App\Role::class, 1)->create(['name' => 'student']);
        
        factory(\App\User::class, 1)->create([
            'names' => 'admin',
            'first_name' => 'admin',
            'second_name' => 'admin',
            'email'=>'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role_id' => \App\Role::ADMIN
        ]);
        factory(\App\Admin::class, 1)->create(['user_id' => 1]);

        factory(\App\User::class, 1)->create([
            'names' => 'professor',
            'first_name' => 'professor',
            'second_name' => 'professor',
            'email'=>'professor@gmail.com',
            'password' => bcrypt('professor'),
            'role_id' => \App\Role::PROFESSOR
        ]);
        factory(\App\Professor::class, 1)->create(['user_id' => 2]);

        factory(\App\User::class, 1)->create([
            'names' => 'auxiliar',
            'first_name' => 'auxiliar',
            'second_name' => 'auxiliar',
            'email'=>'auxiliar@gmail.com',
            'password' => bcrypt('auxiliar'),
            'role_id' => \App\Role::AUXILIAR
        ]);
        factory(\App\Auxiliar::class, 1)->create(['user_id' => 3]);

        factory(\App\User::class, 1)->create([
            'names' => 'student',
            'first_name' => 'student',
            'second_name' => 'student',
            'email'=>'student@gmail.com',
            'password' => bcrypt('student'),
            'role_id' => \App\Role::STUDENT
        ]);
        factory(\App\Student::class, 1)->create(['user_id' => 4]);

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

        factory(\App\Management::class, 1)->create([
            'semester' => '1',
            'managements' => '2019',
        ]);

        factory(\App\Management::class, 1)->create([
            'semester' => '2',
            'managements' => '2019',
        ]);
    }
}
