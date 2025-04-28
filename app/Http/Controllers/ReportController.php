<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $groups = Group::latest()->get()->pluck('name', 'id');
        $subjects = Subject::latest()->get()->pluck('name', 'id');
        $teachers = Teacher::latest()->get()->pluck('name', 'id');
        $query = DB::table('records');
        if ($request->filled('group_id')) {
            $query->whereIn('group_id', $request->group_id);
        }
        if ($request->filled('subject_id')) {
            $query->whereIn('subject_id', $request->subject_id);
        }
        if ($request->filled('teacher_id')) {
            $query->whereIn('teacher_id', $request->teacher_id);
        }
        if ($request->filled('attend')) {
            $query->where('attend_percentage', '>', $request->attend);
        }
        if ($request->filled('assign')) {
            $query->where('assign_percentage', '>', $request->assign);
        }
        $report = $query->selectRaw('
            COUNT(DISTINCT student_id) as StudentNumber,
            COUNT(DISTINCT group_id) as GroupsNumber,
            COUNT(DISTINCT subject_id) as SubjectNumber,
            COUNT(DISTINCT teacher_id) as TeacherNumber,
            AVG(assign_percentage) as AverageAssignPercentage,
            AVG(attend_percentage) as AverageAttendPercentage
        ')->first();
        return view('report.index',[
            'groups' => $groups,
            'subjects' => $subjects,
            'teachers' => $teachers,
            'report' => $report,
        ]);
    }

}
