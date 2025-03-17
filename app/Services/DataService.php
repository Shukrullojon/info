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
                        'jdu_id' => $data['subject_jdu_id'] ?? 0,
                    ],[
                        'name' => $data['subject_name'] ?? 0,
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

    public static function student(){
        $token = config('custom.token');
        $link = config('custom.student_link');
        $response = DataGateway::send($link, "POST", $token, []);
        $ids = [
            200010,
            200016,
            200027,
            200057,
            200112,
            200495,
            200679,
            200753,
            200923,
            200952,
            201002,
            201156,
            201232,
            201400,
            200065,
            201219,
            201346,
            201396,
            210041,
            210042,
            210043,
            210148,
            210162,
            210239,
            210248,
            210263,
            210289,
            210339,
            210359,
            210405,
            210411,
            210413,
            210476,
            210509,
            210512,
            210528,
            210622,
            210708,
            210736,
            210781,
            210917,
            210986,
            211087,
            211109,
            211124,
            211132,
            211133,
            211136,
            211171,
            211258,
            211279,
            211285,
            211337,
            211408,
            211433,
            211462,
            211477,
            211548,
            211629,
            211694,
            211718,
            211739,
            211760,
            211782,
            211835,
            211838,
            211861,
            211972,
            212003,
            212015,
            212108,
            212161,
            212202,
            212264,
            212265,
            212273,
            212290,
            212294,
            212355,
            212490,
            212521,
            212591,
            214015,
            214167,
            214199,
            214200,
            214252,
            214383,
            214398,
            214502,
            214531,
            214577,
            214598,
            214608,
            214609,
            214682,
            214733,
            214742,
            214773,
            214775,
            214793,
            214815,
            214843,
            214908,
            214913,
            214955,
            214970,
            215031,
            215045,
            215051,
            215061,
            215081,
            215089,
            215091,
            215112,
            215131,
            215168,
            215186,
            215190,
            215217,
            215219,
            215221,
            211947,
            214823,
            214661,
            211552,
            220075,
            220237,
            220308,
            220317,
            220366,
            220412,
            220574,
            220689,
            220785,
            220802,
            221110,
            221221,
            222040,
            223146,
            224016,
            224097,
            224313,
            224660,
            224939,
            225249,
            225453,
            220264,
            221121,
            223377,
            224197,
            225094,
            225594,
            221156,
            221809,
            223380,
            225811,
            226133,
            226166,
            226252,
            226278,
            226324,
            226348,
            226453,
            226456,
            226549,
            226618,
            226682,
            226692,
            226699,
            226713,
            226737,
            226789,
            226828,
            226910,
            227020,
            227025,
            227037,
            227051,
            227089,
            227092,
            227130,
            227274,
            227448,
            227481,
            227705,
            227887,
            228060,
            228072,
            228073,
            228074,
            228193,
            228502,
            228526,
            228642,
            228679,
            228736,
            228789,
            228793,
            228805,
            228862,
            228877,
            229027,
            229251,
            229290,
            229334,
            229453,
            229679,
            229858,
            220013,
            220050,
            220077,
            220084,
            220130,
            220153,
            220171,
            220194,
            220236,
            220282,
            220286,
            220312,
            220345,
            220349,
            220354,
            220363,
            220383,
            220404,
            220413,
            220422,
            220448,
            220487,
            220562,
            220563,
            220572,
            220603,
            220640,
            220650,
            220677,
            220708,
            220721,
            220749,
            220813,
            220814,
            220847,
            220862,
            220949,
            220983,
            220986,
            220998,
            221002,
            221161,
            221484,
            221594,
            221852,
            221926,
            221927,
            221936,
            222084,
            222125,
            222128,
            222176,
            222211,
            222339,
            222365,
            222447,
            222490,
            222514,
            222553,
            222580,
            222707,
            222761,
            222768,
            222784,
            222789,
            222850,
            222881,
            222933,
            222952,
            222971,
            223028,
            223065,
            223182,
            223211,
            223251,
            223280,
            223341,
            223468,
            223683,
            224049,
            224071,
            224246,
            224337,
            224425,
            224433,
            224477,
            224515,
            224530,
            224551,
            224565,
            224572,
            224658,
            224672,
            224766,
            224800,
            224801,
            224831,
            224845,
            224850,
            224928,
            225158,
            225175,
            225184,
            225321,
            225323,
            225326,
            228068,
            226516,
            227655,
            2300009,
            2300185,
            2300196,
            2310026,
            2310044,
            2300038,
            2300052,
            2300032,
            2300033,
            2300162,
            2300141,
            2300008,
            2300160,
            2300051,
            2300129,
            2300111,
            2300020,
            2300037,
            2300109,
            2300169,
            2310116,
            2310371,
            2310296,
            2310278,
            2310144,
            2310159,
            2310231,
            2310257,
            2310286,
            2310405,
            2310935,
            2310717,
            2310594,
            2310779,
            2310481,
            2310652,
            2310714,
            2310607,
            2310513,
            2310532,
            2310625,
            2311168,
            2311138,
            2311433,
            2311346,
            2311237,
            2311076,
            2311506,
            2311251,
            2311102,
            2311143,
            2311197,
            2311047,
            2311509,
            2312302,
            2311753,
            2312703,
            2312280,
            2312760,
            2312562,
            2312834,
            2312125,
            2314733,
            2312136,
            2312872,
            2311868,
            2311805,
            2312426,
            2312267,
            2312812,
            2311770,
            2311813,
            2311828,
            2313522,
            2313039,
            2313123,
            2313136,
            2312048,
            2313631,
            2313064,
            2314346,
            2314393,
            2313943,
            2314260,
            2314313,
            2313933,
            2313983,
            2313638,
            2314024,
            2314277,
            2315024,
            2314753,
            2314787,
            2315403,
            2310919,
            2314949,
            2314633,
            2314715,
            2314606,
            2313192,
            2312883,
            2316236,
            2314509,
            2314429,
            2314883,
            2315939,
            2313619,
            2314874,
            2314818,
            2314776,
            2314824,
            2315176,
            2315354,
            2315155,
            2315971,
            2314877,
            2311525,
            2315092,
            2316120,
            2316087,
            2316105,
            2316247,
            2314980,
            2314858,
            2311867,
            2314644,
            2310381,
            2311194,
            2316145,
            2310141,
            2310825,
            2313353,
            2316499,
            2316135,
            2313218,
            2315025,
            2315323,
            2311087,
            2311921,
            2313760,
            2316084,
            2316082,
            2313301,
            2310684,
            2314069,
            2316514,
            2316126,
            2311058,
            2400000,
            2400009,
            2400011,
            2400019,
            2400036,
            2400050,
            2400051,
            2400054,
            2400063,
            2400071,
            2400087,
            2400101,
            2400112,
            2400121,
            2400153,
            2400184,
            2400878,
            2400879,
            2400982,
            2401008,
            2401011,
            2401146,
            2401028,
            2401034,
            2401035,
            2401041,
            2401043,
            2401044,
            2401054,
            2401057,
            2401058,
            2401059,
            2401060,
            2404744,
            2401067,
            2404402,
            2401076,
            2401077,
            2401120,
            2401133,
            2401145,
            2401015,
            2401165,
            2401178,
            2401211,
            2401224,
            2401230,
            2401235,
            2401243,
            2401277,
            2401285,
            2401287,
            2401303,
            2401328,
            2401348,
            2401360,
            2401408,
            2401444,
            2401525,
            2401779,
            2401815,
            2401866,
            2401894,
            2402048,
            2401071,
            2402240,
            2402277,
            2402704,
            2402746,
            2402754,
            2402802,
            2402814,
            2402815,
            2402866,
            2402905,
            2402940,
            2403028,
            2403082,
            2403095,
            2403149,
            2403250,
            2403291,
            2403294,
            2403418,
            2403608,
            2403805,
            2401061,
            2403810,
            2403882,
            2404142,
            2404149,
            2404167,
            2404239,
            2404280,
            2404299,
            2404300,
            2404327,
            2404434,
            2404437,
            2404490,
            2404570,
            2404592,
            2404691,
            2404698,
            2404774,
            2404780,
            2401079,
            2400981,
            2401078,
            2402718,
            2401080,
            2401063,
            2402217,
            2401066,
            2401078,
            2404750,
            2400017,
            2403677,
            2403968,
            2404292,
            2404808,
            2404834,
            2402856,
            2401954,
            2404800,
            2400026,
            2400088,
            2401571,
            2401902,
            2403642,
            2404471,
            2401085,
            2404836,
            2404820,
            2404895,
            2404736,
            2403410,
            2401072,
            2401084,
            2401082,
            2403158,
            2404865,
            2404867,
        ];
        if (isset($response['data'])){
            foreach ($response['data'] as $data) {
                $jdu_id = trim($data["student_id"] ?? 0);
                if(in_array($jdu_id, $ids)){
                    Student::updateOrCreate([
                        'jdu_id' => $jdu_id,
                    ],[
                        'name' => $data['surname']." ".$data['given_name'],
                        'surname' => $data['surname'] ?? "",
                        'given_name' => $data['given_name'] ?? "",
                        'phone' => $data["phone_number"],
                        'parent_phone' => $data["contact_number"],
                        'status' => 1,
                    ]);
                }
            }
        }
        return true;
    }

    public static function percentage(){
        $students = Student::get();
        foreach ($students as $student) {
            $totalScore = 0;
            $totalLessonCount = 0;

            $totalAttendance = 0;
            $totalLessonCountAttendance = 0;
            foreach ($student->scores as $score) {
                $totalScore += $score->totalScore;
                $totalLessonCountAttendance += $score->lessonCount;
                $attendance = json_decode($score->attendances, true);
                $k = 0;
                $all = $score->lessonCount;
                if (!empty($attendance)) {
                    foreach ($attendance as $a) {
                        if ($a['status'] == "P" or $a['status'] == "E" or $a['status'] == "L") {
                            $k++;
                            $totalAttendance++;
                        }
                    }
                    if ($all > 0){
                        $score->update([
                            'attendance_percentage' => round($k/$all*100),
                        ]);
                    }
                }

                $lesson_count = count(array_filter(json_decode($score->scores ?? "{}", true),"is_numeric"));
                $totalLessonCount += $lesson_count;
                if ($lesson_count > 0) {
                    $score->update([
                        "score_percentage" => round(($score->totalScore / ($lesson_count * 5)) * 100),
                    ]);
                }
            }

            if($totalLessonCount > 0){
                $student->update([
                    'total_percentage_score' => ($totalScore/ ($totalLessonCount*5)) * 100,
                ]);
            }
            if($totalLessonCountAttendance > 0){
                $student->update([
                    'total_percentage_attendance' => ($totalAttendance/$totalLessonCountAttendance)*100,
                ]);
            }
        }

        return 0;
    }

}


