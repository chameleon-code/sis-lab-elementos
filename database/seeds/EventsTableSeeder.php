<?php
use Illuminate\Database\Seeder;
class EventsTableSeeder extends Seeder
{
     public function run()
     {
       DB::table('events')->insert([
         ['id'=>1, 'text'=>'Bloque #1', 'start_date'=>'2019-05-06 08:15:00',
            'end_date'=>'2019-05-06 09:45:00'],
         ['id'=>2, 'text'=>'Bloque #2', 'start_date'=>'2019-05-07 08:15:00',
            'end_date'=>'2019-05-07 09:45:00'],
         ['id'=>3, 'text'=>'Bloque #3', 'start_date'=>'2019-05-08 08:15:00',
            'end_date'=>'2019-05-08 09:45:00'],
         ['id'=>4, 'text'=>'Bloque #4', 'start_date'=>'2019-05-09 08:15:00',
            'end_date'=>'2019-05-09 09:45:00'],
         ['id'=>5, 'text'=>'Bloque #5', 'start_date'=>'2019-05-10 08:15:00',
            'end_date'=>'2019-05-10 09:45:00']
         ]);
     }
}