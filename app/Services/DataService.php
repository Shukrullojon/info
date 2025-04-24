<?php

namespace App\Services;

use App\Gateways\DataGateway;
use App\Models\Group;
use App\Models\Link;
use App\Models\Record;
use App\Models\Score;
use App\Models\Score2;
use App\Models\Score3;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;

class DataService
{
    public static function link()
    {
        $links = Link::where('status',1)->get();
        foreach ($links as $link) {
            $datas = DataGateway::send($link->link);
            if (is_null($datas))
                return true;
            if (isset($datas['data'])){
                foreach ($datas['data'] as $data) {
                    $group = Group::firstOrCreate([
                        'name' => $data['group_name'] ?? 0,
                    ],[
                        'status' => 1,
                    ]);
                    $subject = Subject::firstOrCreate([
                        'name' => $data['subject_name'] ?? 0,
                    ],[
                        'status' => 1,
                    ]);
                    $teacher = Teacher::firstOrCreate([
                        'jdu_id' => $data['teacher_id'] ?? 0,
                    ],[
                        'name' => $data['teacher_name'] ?? 0,
                        'status' => 1,
                    ]);
                    $student = Student::where('jdu_id',$data['student_id'])->first();
                    if (empty($student)) {
                        continue;
                    }
                    Record::updateOrCreate(
                        [
                            'student_id' => $student->id,
                            'group_id' => $group->id,
                            'subject_id' => $subject->id,
                            'teacher_id' => $teacher->id,
                        ],
                        Record::updateInfo($data)
                    );
                }
            }
        }
    }

    public static function percentage(){
        $records = Record::groupBy('student_id')->get();
        foreach ($records as $record) {
            if(!empty($record)){
                $r = Record::where('student_id', $record->student_id)
                    ->selectRaw('
                                    SUM(total_current_grade) as total_current_grade,
                                    SUM(total_full_grade) as total_full_grade,
                                    SUM(total_lessons) as total_lessons,
                                    SUM(presents) as presents
                                ')->first();
                if (!empty($r)) {
                    $record->student->update([
                        'total_score' => $r->total_full_grade == 0 ? 0 : round(($r->total_current_grade / $r->total_full_grade) * 100),
                        'total_attendance' => $r->total_lessons == 0 ? 0 : round(($r->presents / $r->total_lessons) * 100),
                    ]);
                }
            }
        }
        return 0;
    }

    public static function truncate()
    {
        Record::truncate();
        return 0;
    }
}


