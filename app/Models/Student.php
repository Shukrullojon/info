<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = "students";

    protected $guarded = [];

    static $statuses = [
        1 => 'Study',
        4 => 'Graduated',
    ];

    static $is_sms = [
        1 => 'Send',
        0 => 'No Send',
    ];

    public static function boot(){
        parent::boot();
        self::created(function($model){
            Token::create([
                'student_id' => $model->id,
                'token' => substr(hash('sha256', $model->jdu_id."_".$model->phone."_student"), 0, 12),
                'type' => 1,
            ]);
            Token::create([
                'student_id' => $model->id,
                'token' => substr(hash('sha256', $model->jdu_id."_".$model->parent_phone."_parent"), 0, 12),
                'type' => 2,
            ]);
        });
    }

    public function records()
    {
        return $this->hasMany(Record::class);
    }
}
