<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Group;
use App\Sesion;

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

        factory(\App\User::class, 15)->create([ 'role_id' => \App\Role::PROFESSOR ])
        ->each(function (\App\User $u){
            factory(\App\Professor::class, 1)->create(['user_id' => $u->id]);
        });

        factory(\App\User::class, 15)->create([ 'role_id' => \App\Role::AUXILIAR ])
        ->each(function (\App\User $u){
            factory(\App\Auxiliar::class, 1)->create(['user_id' => $u->id]);
        });

        // GESTIONES

        factory(\App\Management::class, 2)->create()
        ->each(function (\App\Management $m){
            Storage::makeDirectory($m->management_path);
        });

        // MATERIAS

        factory(\App\SubjectMatter::class, 6)->create();

        // GRUPOS

        factory(\App\Group::class, 20)->create();

        // BLOQUES

        factory(\App\Block::class, 5)->create()
        ->each(function (\App\Block $b){
            Storage::makeDirectory($b->block_path);
            $dates = \App\Sesion::autodate('2019-02-4', '2019-06-3');
            $i = 1;
            foreach($dates as $date){
                Sesion::create([
                    'block_id' => $b->id,
                    'number_sesion' => $i,
                    'date_start' => $date['start'],
                    'date_end' => $date['end'],
                ]);
                $i++;
            }
        });

        factory(\App\BlockGroup::class, 20)->create();

        factory(\App\User::class, 1)->create([
            'names' => 'student',
            'first_name' => 'student',
            'second_name' => 'student',
            'email'=>'student@gmail.com',
            'password' => bcrypt('student'),
            'role_id' => \App\Role::STUDENT
        ]);
        factory(\App\Student::class, 1)->create(['user_id' => 34]);

        factory(\App\User::class, 100)->create([ 'role_id' => \App\Role::STUDENT ])
        ->each(function (\App\User $u){
            factory(\App\Student::class, 1)->create([
                'user_id' => $u->id,
                ])
                ->each(function (\App\Student $s){
                    $user = App\User::where("id", "=", $s->user_id)->get()->first();
                    // $group = App\Group::find($s->group_id);
                    // $dir = App\Block::find($s->block_id)->block_path.'/'.$group->name.'/'.base64_encode($user->code_sis);
                    // $s->student_path = $dir;
                    // $s->save();
                    // Storage::makeDirectory($dir);
                });
        });

        // HORARIOS

        factory(\App\Hour::class, 10)->create()
        ->each(function (\App\Hour $h){
            $h->start = App\Hour::START_HOURS[$h->id-1];
            $h->end = App\Hour::END_HOURS[$h->id-1];
            $h->save();
        });

        factory(\App\Day::class, 6)->create()
        ->each(function (\App\Day $d){
            $d->name = App\Day::DAYS[$d->id-1];
            $d->save();
        });

        factory(\App\Laboratory::class, 4)->create()
        ->each(function (\App\Laboratory $l){
            $l->name = App\Laboratory::LABS[$l->id-1];
            $l->capacity = App\Laboratory::CAPS[$l->id-1];
            $l->save();
        });

        factory(\App\ScheduleRecord::class, 30)->create();

        factory(\App\BlockSchedule::class, 30)->create();
        
        factory(\App\Task::class, 100)->create();
    }
}
