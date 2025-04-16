<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $groups = Group::latest()->get()->pluck('name', 'id');
        $subjects = Subject::latest()->get()->pluck('name', 'id');
        $teachers = Teacher::latest()->get()->pluck('name', 'id');
        return view('report.index',[
            'groups' => $groups,
            'subjects' => $subjects,
            'teachers' => $teachers,
        ]);
    }

}
