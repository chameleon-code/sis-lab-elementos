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
use App\Management;
use App\Task;
use App\StudentTask;

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
            'password' => bcrypt('chameleoncodesoft2019'),
            'role_id' => \App\Role::ADMIN
        ]);
        factory(\App\Admin::class, 1)->create(['user_id' => 1]);

        // factory(\App\User::class, 1)->create([
        //     'names' => 'professor',
        //     'first_name' => 'professor',
        //     'second_name' => 'professor',
        //     'email'=>'professor@gmail.com',
        //     'password' => bcrypt('secret'),
        //     'role_id' => \App\Role::PROFESSOR
        // ]);
        // factory(\App\Professor::class, 1)->create(['user_id' => 2]);

        // factory(\App\User::class, 1)->create([
        //     'names' => 'auxiliar',
        //     'first_name' => 'auxiliar',
        //     'second_name' => 'auxiliar',
        //     'email' => 'auxiliar@gmail.com',
        //     'password' => bcrypt('auxiliar'),
        //     'role_id' => \App\Role::AUXILIAR
        // ]);
        // factory(\App\Auxiliar::class, 1)->create(['user_id' => 3, 'block_id' => null]);

        
        // factory(\App\User::class, 1)->create([
        //     'names' => 'student',
        //     'first_name' => 'student',
        //     'second_name' => 'student',
        //     'email'=>'student@gmail.com',
        //     'password' => bcrypt('student'),
        //     'role_id' => \App\Role::STUDENT
        // ]);
        // factory(\App\Student::class, 1)->create(['user_id' => 4]);
        
        factory(\App\User::class, 1)->create([
            'names' => 'Leticia',
            'first_name' => 'Blanco',
            'second_name' => 'Coca',
            'email'=>'leticia.blanco@gmail.com',
            'password' => bcrypt('secret'),
            'role_id' => \App\Role::PROFESSOR
        ]);
        factory(\App\Professor::class, 1)->create(['user_id' => 2]);
        factory(\App\User::class, 1)->create([
            'names' => 'Rosemary',
            'first_name' => 'Torrico',
            'second_name' => 'Bascopé',
            'email'=>'rosemary.torrico@gmail.com',
            'password' => bcrypt('secret'),
            'role_id' => \App\Role::PROFESSOR
        ]);
        factory(\App\Professor::class, 1)->create(['user_id' => 3]);
        
        // factory(\App\User::class, 1)->create([
        //     'names' => 'Corina',
        //     'first_name' => 'Flores',
        //     'second_name' => 'Villarroel',
        //     'email'=>'corina.flores@gmail.com',
        //     'password' => bcrypt('secret'),
        //     'role_id' => \App\Role::PROFESSOR
        // ]);
        // factory(\App\Professor::class, 1)->create(['user_id' => 6]);

        // factory(\App\User::class, 1)->create([
        //     'names' => 'Vladimir Abel',
        //     'first_name' => 'Costas',
        //     'second_name' => 'Jauregui',
        //     'email'=>'vladimir.costas@gmail.com',
        //     'password' => bcrypt('secret'),
        //     'role_id' => \App\Role::PROFESSOR
        // ]);
        // factory(\App\Professor::class, 1)->create(['user_id' => 7]);

        // // GESTIONES

        // Management::create([
        //     'semester' => 1,
        //     'managements' => 2019,
        //     'start_management' => '2019-02-01',
        //     'end_management' => '2019-07-10',
        //     'management_path' => 'folders/2019-1',
        //     'enable_inscription' => 0,
        // ]);
        Management::create([
            'semester' => 2,
            'managements' => 2019,
            'start_management' => '2019-08-19',
            'end_management' => '2019-12-02',
            'management_path' => 'folders/2019-2',
            'enable_inscription' => 0,
        ]);

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
            'professor_id' => 1,
        ]);
        $group3 = Group::create([
            'name' => '3',
            'subject_matter_id' => 1,
            'professor_id' => 1,
        ]);
        $group1 = Group::create([
            'name' => '1',
            'subject_matter_id' => 1,
            'professor_id' => 2,
        ]);
        $group5 = Group::create([
            'name' => '5',
            'subject_matter_id' => 1,
            'professor_id' => 2,
        ]);
        // $group7 = Group::create([
        //     'name' => '7',
        //     'subject_matter_id' => 1,
        //     'professor_id' => 3,
        // ]);
        // $group10 = Group::create([
        //     'name' => '10',
        //     'subject_matter_id' => 1,
        //     'professor_id' => 4,
        // ]);

        //factory(\App\Group::class, 5)->create();

        // BLOQUES

        $block_LR = Block::create([
            'management_id' => 1,
            'name' => 'Bloque-LR',
            'available' => 1,
            'block_path' => 'folders/2019-2/Bloque-LR'
        ]);
        Storage::makeDirectory($block_LR->block_path);
        
        // $dates = \App\Sesion::autodate('2019-07-20', '2019-11-30');
        // $i = 1;
        // foreach($dates as $date){
        //     Sesion::create([
        //         'block_id' => $block_lcv->id,
        //         'number_sesion' => $i,
        //         'date_start' => $date['start'],
        //         'date_end' => $date['end'],
        //     ]);
        //     $i++;
        // }

        BlockGroup::create([
            'block_id' => $block_LR->id,
            'group_id' => $group2->id,
        ]);
        BlockGroup::create([
            'block_id' => $block_LR->id,
            'group_id' => $group3->id,
        ]);
        BlockGroup::create([
            'block_id' => $block_LR->id,
            'group_id' => $group1->id,
        ]);
        BlockGroup::create([
            'block_id' => $block_LR->id,
            'group_id' => $group5->id,
        ]);
        // BlockGroup::create([
        //     'block_id' => $block_lcv->id,
        //     'group_id' => $group7->id,
        // ]);
        // BlockGroup::create([
        //     'block_id' => $block_lcv->id,
        //     'group_id' => $group10->id,
        // ]);
            
        // factory(\App\User::class, 5)->create(['role_id' => \App\Role::AUXILIAR])
        //     ->each(function (\App\User $u) {
        //         factory(\App\Auxiliar::class, 1)->create(['user_id' => $u->id]);
        // });

        // // HORARIOS

        factory(\App\Hour::class, 1)->create()
        ->each(function (\App\Hour $h){
            $h->start = App\Hour::START_HOURS[10];
            $h->end = App\Hour::END_HOURS[10];
            $h->save();
        });

        factory(\App\Day::class, 6)->create()
        ->each(function (\App\Day $d){
            $d->name = App\Day::DAYS[$d->id-1];
            $d->save();
        });

        factory(\App\Laboratory::class, 1)->create()
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
                    'professor' => App\User::findOrFail(2)->names." ".App\User::findOrFail(2)->first_name,
                    'subject' => 'ELEMENTOS DE PROGRAMACIÓN Y ESTRUCTURA DE DATOS',
                    'color' => 'color-2',
                ]);
            }
        }

        // factory(\App\ScheduleRecord::class, 20)->create();

        for($i=1 ; $i<=5 ; $i++){
            $registered = 0;
            switch($i){
                case 1:
                    $registered = 35;
                    break;
                case 2:
                    $registered = 35;
                    break;
                case 3:
                    $registered = 21;
                    break;
                case 4:
                    $registered = 26;
                    break;
                case 5:
                    $registered = 35;
                    break;
                case 6:
                    $registered = 17;
                    break;
                case 7:
                    $registered = 34;
                    break;
                case 8:
                    $registered = 34;
                    break;
                case 9:
                    $registered = 21;
                    break;
            }
            BlockSchedule::create([
                'schedule_id' => $i,
                'block_id' => 1,
                'registered' => 0,
            ]);
        }

        // factory(\App\BlockSchedule::class, 20)->create();
        
        // factory(\App\Task::class, 100)->create();

        // INSCRIPCIONES

        // for($i=0 ; $i<sizeof(App\Database::NAMES) ; $i++){
        //     $user = User::create([
        //         'code_sis' => $faker->unique()->randomNumber(8),
        //         'role_id' => \App\Role::STUDENT,
        //         'names' => App\Database::NAMES[$i],
        //         'first_name' => App\Database::FIRST_NAME[$i],
        //         'second_name' => App\Database::SECOND_NAME[$i],
        //         'email' => App\Database::FIRST_NAME[$i]."@"."gmail.com",
        //         'password' => bcrypt('secret'),
        //     ]);

        //     switch($user->id){
        //         case 134:
        //             $user->code_sis = 49136035;
        //             $user->save();
        //             break;
        //         case 208:
        //             $user->code_sis = 57478347;
        //             $user->save();
        //             break;
        //         case 194:
        //             $user->code_sis = 42474514;
        //             $user->save();
        //             break;
        //         case 132:
        //             $user->code_sis = 17347829;
        //             $user->save();
        //             break;
        //         case 227:
        //             $user->code_sis = 27759099;
        //             $user->save();
        //             break;//
        //         case 145:
        //             $user->code_sis = 65772817;
        //             $user->save();
        //             break;
        //         case 173:
        //             $user->code_sis = 2942076;
        //             $user->save();
        //             break;
        //         case 259:
        //             $user->code_sis = 87906344;
        //             $user->save();
        //             break;
        //     }

        //     $student = Student::create([
        //         'user_id' => $user->id,
        //         'ci' => $faker->unique()->randomNumber(8),
        //     ]);
            
        //     $group_name = App\Database::STUDENT_GROUP[$i];
        //     $group = App\Group::where('name', '=', $group_name)->get()->first();
        //     StudentSchedule::create([
        //         'student_id' => $student->id,
        //         'block_schedule_id' => App\Database::BLOCK_SCHEDULES[$i],
        //         'group_id' => $group->id,
        //         'student_path' => Block::find(1)->block_path.'/'.$group->name.'/'.$user->names.'-'.$user->code_sis,
        //     ]);
        // }

        // for($i=0 ; $i<sizeof(App\Database::TASKS) ; $i++){
        //     $professors = ['Leticia Blanco', 'Corina Flores', 'Vladimir Abel Costas'];
        //     $dir = App\Block::findOrFail(1)->block_path;
        //     $semiPath =$dir.'/practices/sesion-'.($i+1).'/';
        //     Storage::makeDirectory($semiPath);
        //     Task::create([
        //         'sesion_id' => $i+1,
        //         'title' => App\Database::TASKS[$i],
        //         'published_by' => $faker->randomElement($professors),
        //         'description' => null,
        //         'task_path' => '/storage/'.$semiPath,
        //         'task_file' => App\Database::NAME_TASKS[$i],
        //     ]);
        // }

        // for($i=0 ; $i<sizeof(App\Database::NUMBER_TASKS) ; $i++){
        //     for($j=0 ; $j<App\Database::NUMBER_TASKS[$i] ; $j++){
        //         $tasks_student = null;
        //         switch($i){
        //             case 0:
        //                 $tasks_student = App\Database::TASKS_STUDENT_1;
        //                 break;
        //             case 1:
        //                 $tasks_student = App\Database::TASKS_STUDENT_2;
        //                 break;
        //             case 2:
        //                 $tasks_student = App\Database::TASKS_STUDENT_3;
        //                 break;
        //             case 3:
        //                 $tasks_student = App\Database::TASKS_STUDENT_4;
        //                 break;
        //             case 4:
        //                 $tasks_student = App\Database::TASKS_STUDENT_5;
        //                 break;//
        //             case 5:
        //                 $tasks_student = App\Database::TASKS_STUDENT_6;
        //                 break;
        //             case 6:
        //                 $tasks_student = App\Database::TASKS_STUDENT_7;
        //                 break;
        //             case 7:
        //                 $tasks_student = App\Database::TASKS_STUDENT_8;
        //                 break;
        //         }
        //         $task_names_student = null;
        //         switch($i){
        //             case 0:
        //                 $task_names_student = App\Database::TASK_NAME_STUDENT_1;
        //                 break;
        //             case 1:
        //                 $task_names_student = App\Database::TASK_NAME_STUDENT_2;
        //                 break;
        //             case 2:
        //                 $task_names_student = App\Database::TASK_NAME_STUDENT_3;
        //                 break;
        //             case 3:
        //                 $task_names_student = App\Database::TASK_NAME_STUDENT_4;
        //                 break;
        //             case 4:
        //                 $task_names_student = App\Database::TASK_NAME_STUDENT_5;
        //                 break;//
        //             case 5:
        //                 $task_names_student = App\Database::TASK_NAME_STUDENT_6;
        //                 break;
        //             case 6:
        //                 $task_names_student = App\Database::TASK_NAME_STUDENT_7;
        //                 break;
        //             case 7:
        //                 $task_names_student = App\Database::TASK_NAME_STUDENT_8;
        //                 break;
        //         }
        //         $student_schedule = StudentSchedule::where('student_id', '=', App\Database::STUDENTS_ID[$i])->get()->first();
        //         $task_path = $student_schedule->student_path.'/sesion-'.$tasks_student[$j].'/';
        //         Storage::makeDirectory($task_path);
        //         StudentTask::create([
        //             'student_id' => App\Database::STUDENTS_ID[$i],
        //             'task_id' => $tasks_student[$j],
        //             'score' => $faker->randomNumber(2),
        //             'observation' => ($faker->randomElement(App\Database::TASK_DESCRIPTION)).$tasks_student[$j],
        //             'task_path' => $task_path,
        //             'task_name' => $task_names_student[$j],
        //             'in_time' => $faker->randomElement(['yes', 'yes', 'yes', 'yes', 'no'])
        //         ]);
        //     }
        // }
    }
}
