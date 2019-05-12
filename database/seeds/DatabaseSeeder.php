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

        //llamada al seeder de events
        $this->call(EventsTableSeeder::class);

        // ROLES

        factory(\App\Role::class, 1)->create(['name' => 'admin']);
        factory(\App\Role::class, 1)->create(['name' => 'professor']);
        factory(\App\Role::class, 1)->create(['name' => 'auxiliar']);
        factory(\App\Role::class, 1)->create(['name' => 'student']);
        
        // USUARIOS

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

        factory(\App\User::class, 40)->create([ 'role_id' => \App\Role::PROFESSOR ])
        ->each(function (\App\User $u){
            factory(\App\Professor::class, 1)->create(['user_id' => $u->id]);
        });

        factory(\App\User::class, 40)->create([ 'role_id' => \App\Role::AUXILIAR ])
        ->each(function (\App\User $u){
            factory(\App\Auxiliar::class, 1)->create(['user_id' => $u->id]);
        });

        factory(\App\User::class, 40)->create([ 'role_id' => \App\Role::STUDENT ])
        ->each(function (\App\User $u){
            factory(\App\Student::class, 1)->create(['user_id' => $u->id]);
        });

        // GESTIONES

        // factory(\App\Management::class, 1)->create([
        //     'semester' => '1',
        //     'managements' => '2019',
        //     'start_management' => '2019-02-01',
        //     'end_management' => '2019-06-01',
        // ]);

        // factory(\App\Management::class, 1)->create([
        //     'semester' => '2',
        //     'managements' => '2019',
        //     'start_management' => '2019-07-01',
        //     'end_management' => '2019-012-01',
        // ]);

        // MATERIAS

        factory(\App\SubjectMatter::class, 1)->create([
            'name' => 'Introducción a la Programación',
        ]);

        factory(\App\SubjectMatter::class, 1)->create([
            'name' => 'Elementos de Programación y Estructura de Datos',
        ]);

        factory(\App\SubjectMatter::class, 1)->create([
            'name' => 'Base de Datos I',
        ]);

        factory(\App\SubjectMatter::class, 1)->create([
            'name' => 'Taller de Sistemas Operativos',
        ]);

        //Horarios
        factory(\App\Laboratory::class, 1)->create([
            'name' => 'Laboratorio - 1'
        ]);
        factory(\App\Laboratory::class, 1)->create([
            'name' => 'Laboratorio - 2'
        ]);
        factory(\App\Laboratory::class, 1)->create([
            'name' => 'Laboratorio - 3'
        ]);
            //Dias
        factory(\App\Day::class, 1)->create([
            'name' => 'Lunes'
        ]);
        factory(\App\Day::class, 1)->create([
            'name' => 'Martes'
        ]);
        factory(\App\Day::class, 1)->create([
            'name' => 'Miercoles'
        ]);
        factory(\App\Day::class, 1)->create([
            'name' => 'Jueves'
        ]);
        factory(\App\Day::class, 1)->create([
            'name' => 'Viernes'
        ]);
            //horas
        
    }
}
