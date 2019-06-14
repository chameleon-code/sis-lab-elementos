<?php

use App\Sesion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;
use App\User;
use App\Student;
use App\SubjectMatter;
use App\Group;
use App\Block;
use App\BlockGroup;
use Illuminate\Console\Scheduling\Schedule;
use App\ScheduleRecord;
use App\BlockSchedule;
use App\StudentSchedule;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

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
            'email' => 'auxiliar@gmail.com',
            'password' => bcrypt('auxiliar'),
            'role_id' => \App\Role::AUXILIAR
        ]);
        factory(\App\Auxiliar::class, 1)->create(['user_id' => 3, 'block_id' => null]);

        
        factory(\App\User::class, 1)->create([
            'names' => 'student',
            'first_name' => 'student',
            'second_name' => 'student',
            'email'=>'student@gmail.com',
            'password' => bcrypt('student'),
            'role_id' => \App\Role::STUDENT
        ]);
        factory(\App\Student::class, 1)->create(['user_id' => 4]);
        
        factory(\App\User::class, 1)->create([
            'names' => 'Leticia',
            'first_name' => 'Blanco',
            'second_name' => 'Coca',
            'email'=>'leticia.blanco@gmail.com',
            'password' => bcrypt('secret'),
            'role_id' => \App\Role::PROFESSOR
        ]);
        factory(\App\Professor::class, 1)->create(['user_id' => 5]);

        factory(\App\User::class, 1)->create([
            'names' => 'Corina',
            'first_name' => 'Flores',
            'second_name' => 'Villarroel',
            'email'=>'corina.flores@gmail.com',
            'password' => bcrypt('secret'),
            'role_id' => \App\Role::PROFESSOR
        ]);
        factory(\App\Professor::class, 1)->create(['user_id' => 6]);

        factory(\App\User::class, 1)->create([
            'names' => 'Vladimir Abel',
            'first_name' => 'Costas',
            'second_name' => 'Jauregui',
            'email'=>'vladimir.costas@gmail.com',
            'password' => bcrypt('secret'),
            'role_id' => \App\Role::PROFESSOR
        ]);
        factory(\App\Professor::class, 1)->create(['user_id' => 7]);

        factory(\App\User::class, 10)->create([ 'role_id' => \App\Role::PROFESSOR ])
        ->each(function (\App\User $u){
            factory(\App\Professor::class, 1)->create(['user_id' => $u->id]);
        });

        // // GESTIONES

        factory(\App\Management::class, 2)->create()
        ->each(function (\App\Management $m){
            Storage::makeDirectory($m->management_path);
        });

        // // MATERIAS

        for($i=0 ; $i<sizeof(App\Database::SUBJECT_MATTERS) ; $i++){
            SubjectMatter::create([
                'name' => App\Database::SUBJECT_MATTERS[$i],
            ]);
        }

        // // GRUPOS

        $group2 = Group::create([
            'name' => '2',
            'subject_matter_id' => 1,
            'professor_id' => 2,
        ]);
        $group7 = Group::create([
            'name' => '7',
            'subject_matter_id' => 1,
            'professor_id' => 3,
        ]);
        $group10 = Group::create([
            'name' => '10',
            'subject_matter_id' => 1,
            'professor_id' => 4,
        ]);

        factory(\App\Group::class, 5)->create();

        // BLOQUES

        $block_lcv = Block::create([
            'management_id' => 2,
            'name' => 'Bloque-lcv',
            'available' => 1,
            'block_path' => 'folders/2019-1/Bloque-lcv'
        ]);

        Storage::makeDirectory($block_lcv->block_path);
        $dates = \App\Sesion::autodate('2019-02-4', '2019-06-24');
        $i = 1;
        foreach($dates as $date){
            Sesion::create([
                'block_id' => $block_lcv->id,
                'number_sesion' => $i,
                'date_start' => $date['start'],
                'date_end' => $date['end'],
            ]);
            $i++;
        }

        BlockGroup::create([
            'block_id' => $block_lcv->id,
            'group_id' => $group2->id,
        ]);
        BlockGroup::create([
            'block_id' => $block_lcv->id,
            'group_id' => $group7->id,
        ]);
        BlockGroup::create([
            'block_id' => $block_lcv->id,
            'group_id' => $group10->id,
        ]);

        // factory(\App\Block::class, 3)->create()
        // ->each(function (\App\Block $b){
        //     Storage::makeDirectory($b->block_path);
        //     $dates = \App\Sesion::autodate('2019-02-4', '2019-06-24');
        //     $i = 1;
        //     foreach($dates as $date){
        //         Sesion::create([
        //             'block_id' => $b->id,
        //             'number_sesion' => $i,
        //             'date_start' => $date['start'],
        //             'date_end' => $date['end'],
        //         ]);
        //         $i++;
        //     }
        // });

        //factory(\App\BlockGroup::class, 2)->create();
            
        factory(\App\User::class, 15)->create(['role_id' => \App\Role::AUXILIAR])
            ->each(function (\App\User $u) {
                factory(\App\Auxiliar::class, 1)->create(['user_id' => $u->id]);
        });
        
        // factory(\App\User::class, 100)->create(['role_id' => \App\Role::STUDENT ])
        // ->each(function (\App\User $u){
        //     factory(\App\Student::class, 1)->create([
        //         'user_id' => $u->id,
        //         ])
        //         ->each(function (\App\Student $s){
        //             $user = App\User::where("id", "=", $s->user_id)->get()->first();
        //             // $group = App\Group::find($s->group_id);
        //             // $dir = App\Block::find($s->block_id)->block_path.'/'.$group->name.'/'.base64_encode($user->code_sis);
        //             // $s->student_path = $dir;
        //             // $s->save();
        //             // Storage::makeDirectory($dir);
        //         });
        // });

        // // HORARIOS

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

        for($i=0 ; $i<sizeof(App\Database::DAY_ID) ; $i++){
            for($j=0 ; $j<sizeof(App\Database::HOUR_ID) ; $j++){
                ScheduleRecord::create([
                    'laboratory_id' => 1,
                    'day_id' => App\Database::DAY_ID[$i],
                    'hour_id' => App\Database::HOUR_ID[$j],
                    'professor' => App\Database::PROFESSOR[$i],
                    'subject' => 'Introducción a la Programación',
                    'color' => 'color-1',
                ]);
            }
        }

        // factory(\App\ScheduleRecord::class, 20)->create();

        for($i=1 ; $i<=9 ; $i++){
            BlockSchedule::create([
                'schedule_id' => $i,
                'block_id' => 1,
            ]);
        }

        // factory(\App\BlockSchedule::class, 20)->create();
        
        // factory(\App\Task::class, 100)->create();

        // INSCRIPCIONES

        for($i=0 ; $i<sizeof(App\Database::NAMES) ; $i++){
            $user = User::create([
                'code_sis' => $faker->unique()->randomNumber(8),
                'role_id' => \App\Role::STUDENT,
                'names' => App\Database::NAMES[$i],
                'first_name' => App\Database::FIRST_NAME[$i],
                'second_name' => App\Database::SECOND_NAME[$i],
                'email' => App\Database::FIRST_NAME[$i]."@"."gmail.com",
                'password' => bcrypt(App\Database::FIRST_NAME[$i]),
            ]);

            $student = Student::create([
                'user_id' => $user->id,
                'ci' => $faker->unique()->randomNumber(8),
            ]);
            
            $group_name = App\Database::STUDENT_GROUP[$i];
            $group = App\Group::where('name', '=', $group_name)->get()->first();
            StudentSchedule::create([
                'student_id' => $student->id,
                'block_schedule_id' => App\Database::BLOCK_SCHEDULES[$i],
                'group_id' => $group->id,
            ]);
        }
    }
}
