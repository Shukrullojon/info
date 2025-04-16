<?php

namespace App\Console\Commands;

use App\Models\Student;
use App\Services\SmsService;
use Illuminate\Console\Command;
use App\Services\DataService;
use Illuminate\Support\Facades\DB;

class DataCommand extends Command
{

    protected $signature = 'data {arg}';

    protected $description = 'Command description';


    public function handle()
    {
        $method = $this->argument('arg');
        if (method_exists($this, $method)) {
            $this->$method();
        }
        return 0;
    }

    public function link()
    {
        DataService::link();
        return 0;
    }

    public function student()
    {
        DataService::student();
        return 0;
    }

    public function percentage()
    {
        DataService::percentage();
        return 0;
    }
    public function sms_parent()
    {
        $students = Student::select(
            "students.id",
            "students.parent_phone as contact",
            DB::raw('CONCAT("Hurmatli ota-onalar, farzandingizning Japan Digital Universitydagi o‘zlashtirish va davomat ko‘rsatkichlarini quyidagi havola orqali ko‘rishingiz mumkin: https://data.jdu.uz/", COALESCE(tokens.token, "N/A")) as message')
        )
            ->leftJoin('tokens', function ($join) {
                $join->on('students.id', '=', 'tokens.student_id')
                    ->where('tokens.type', 1);
            })
            ->where('students.parent_phone', '!=', null)
            ->where('students.is_sms', true)
            ->where('students.is_send', false)
            ->limit(50)
            ->get()
            ->toArray();
        SmsService::send($students);
        return 0;
    }

    public function update()
    {
        Student::update(['is_send'=>false]);
        return 0;
    }
    public function sms_student(){
        $students = Student::select(
            "students.id",
            "students.phone as contact",
            DB::raw('CONCAT("Hurmatli talaba, Japan Digital Universitydagi o‘zlashtirish va davomat ko‘rsatkichlaringizni quyidagi havola orqali ko‘rishingiz mumkin: https://data.jdu.uz/", COALESCE(tokens.token, "N/A")) as message')
        )
            ->leftJoin('tokens', function ($join) {
                $join->on('students.id', '=', 'tokens.student_id')
                    ->where('tokens.type', 2);
            })
            ->where('students.phone', '!=', null)
            ->where('students.is_sms', true)
            ->where('students.is_send', false)
            ->limit(50)
            ->get()
            ->toArray();
        SmsService::send($students);
        return 0;
    }

}
