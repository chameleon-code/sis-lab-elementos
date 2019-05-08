<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch (Auth::user()->role_id) {
            case Role::ADMIN:
                return view('components.sections.adminSection');
                break;
            case Role::PROFESSOR:
                return view('components.sections.professorSection');
                break;
            case Role::AUXILIAR:
                return view('components.sections.auxiliarSection');
                break;
            case Role::STUDENT:
                return view('components.contents.student.activities');
                break;
        }
    }
}
