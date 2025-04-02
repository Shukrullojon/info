<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Record extends Model
{
    use HasFactory;

    protected $table = 'records';

    protected $guarded = [];

    public static function updateInfo($data)
    {
        if (isset($data['assignments']) and is_array($data['assignments'])) {
            $update_info = [
                'assignments' => json_encode($data['assignments'] ?? [], true),
                'total_current_grade' => $data['total_current_grade'] ?? 0,
                'total_full_grade' => $data['total_full_grade'] ?? 0,
                'assign_percentage' => $data['total_full_grade'] == 0 ? 0 : round(($data['total_current_grade'] / $data['total_full_grade']) * 100),
            ];
        } else if (isset($data['attendances']) and is_array($data['attendances'])) {
            $update_info = [
                'attendances' => json_encode($data['attendances'], true),
                'total_lessons' => $data['total_lessons'] ?? 0,
                'presents' => $data['presents'] ?? 0,
                'attend_percentage' => $data['total_lessons'] == 0 ? 0 : round(($data['presents'] / $data['total_lessons']) * 100),
            ];
        }
        return $update_info;
    }

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            self::updateStudentPercentage($model);
        });
        self::updated(function ($model) {
            self::updateStudentPercentage($model);
        });
    }

    private static function updateStudentPercentage($model)
    {
        $record = Record::where('student_id', 485)
            ->selectRaw('
                SUM(total_current_grade) as total_current_grade,
                SUM(total_full_grade) as total_full_grade,
                SUM(total_lessons) as total_lessons,
                SUM(presents) as presents
            ')->first();
        if (!empty($record)) {
            $model->student->update([
                'total_score' => $record->total_full_grade == 0 ? 0 : round(($record->total_current_grade / $record->total_full_grade) * 100),
                'total_attendance' => $record->total_lessons == 0 ? 0 : round(($record->presents / $record->total_lessons) * 100),
            ]);
        }
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
