<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\SubjectMatter;
use App\Management;

class SubjectMattersTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;
    public function testCreateSubjectMatters(){

        Management::create(['semester' => '1',
                            'managements' => 2019]);
        SubjectMatter::create(['managements_id' => 1,
                                'name' => 'elementos de programacion']);
        $subjectMartter = SubjectMatter::getAllSubjectMatters();
        $this->assertCount(1,$subjectMartter);
    }
}
