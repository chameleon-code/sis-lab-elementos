<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ADMIN = 1;
    const PROFESSOR = 2;
    const AUXILIAR = 3;
    const STUDENT = 4;
}
