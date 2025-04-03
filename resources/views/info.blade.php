@extends('layouts.link')
@section('content')
    <!-- Student Info Header -->
    @if(!empty($student))
        <div class="max-w-4xl mx-auto mb-6 bg-white shadow-lg rounded-md p-4 flex items-center space-x-4">
            <img src="{{ asset("public/rating/student.png") }}" alt="Student Icon" class="w-16 h-16 rounded-full border border-gray-300">
            <div>
                <h1 class="text-xl font-bold text-gray-900"> <span class="text-gray-900">{{ $student->name ?? "" }}</span></h1>
                <p class="text-sm font-bold text-gray-500">Student ID: <span class="text-gray-600">{{ $student->jdu_id ?? "" }}</span></p>
            </div>
        </div>

        <div class=" gap-4 max-w-4xl mx-auto">
            <!-- Main Table -->
            <div class="col-span-2">
                <div class="block w-full overflow-x-auto border bg-white shadow-lg rounded-md">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <tbody id="main-table" class="divide-y divide-gray-100">
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Lesson Details -->
            <div id="lesson-details" class="col-span-1 hidden p-4 bg-white shadow-lg rounded-md">
                <h2 class="text-lg font-bold mb-4">Lesson Details</h2>
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-2">Lesson</th>
                        <th scope="col" class="px-4 py-2">Mark</th>
                    </tr>
                    </thead>
                    <tbody id="lesson-table" class="bg-white divide-y divide-gray-200">
                    <!-- Lesson rows will be dynamically added here -->
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <h1>Ma'lumot topilmadi!</h1>
    @endif
    <input name="attendance_average" value="0" id="attendance_average" type="hidden">
    <script>
        // Example data
        @if(!empty($student))
        const data = [
            {
                category: "Baholari",
                className:"text-center",
                percentage: {{ $student->total_score }},
                subjects: [
                        @php $records = $student->records ?: []; @endphp
                        @foreach($records as $r)
                        @php
                            $balls = json_decode($r->assignments, true);
                            $balls = $balls ?: [];
                        @endphp
                    {
                        subject: "{{ $r->subject->name ?? "" }}",
                        percentage: {{ $r->assign_percentage ?? 0 }},
                        color: "bg-cyan-600",
                        lessons: [
                                @foreach($balls as $b)
                                    { lesson: "{{ $b['title'] }}", mark: "{{$b['current_grade']}}" },
                                @endforeach
                        ],
                    },
                    @endforeach

                ],
            },
            {
                category: "Davomati",
                className:"text-left max-sm:pl-8",
                percentage: {{ $student->total_attendance ?? 0 }},
                subjects: [
                        @foreach($records as $r)
                        @php
                            $attends = json_decode($r->attendances, true);
                            $attends = $attends ?: [];
                        @endphp
                    {
                        subject: "{{ $r->subject->name ?? "" }}",
                        percentage: {{ $r->attend_percentage ?? 0 }},
                        color: "bg-orange-300",
                        lessons: [
                                @foreach($attends as $attend)
                            {
                                lesson: "{{ date("d.m.Y", strtotime($attend['date'])) }}",
                                mark: @if($attend['status'] == "U") "❌ Kelmadi" @elseif($attend['status'] == "L") "✅ Kech qoldi" @elseif($attend['status']=="E") "❌ Sababli kelmadi" @elseif($attend['status'] == "") "⌛️ Rejalashtirilgan dars" @else "✅ Keldi" @endif,
                                color: @if($attend['status'] == "U") "red" @elseif($attend['status'] == "E") "#6B7280" @elseif($attend['status'] == "L") "yellow" @elseif($attend['status'] == "") "#6B7280" @else "green" @endif,
                            },
                            @endforeach
                        ],
                    },
                    @endforeach
                ],
            },
        ];
        @endif

        const mainTable = document.getElementById("main-table");
        const lessonDetails = document.getElementById("lesson-details");
        const lessonTable = document.getElementById("lesson-table");

        // Populate main table
        data.forEach((category, categoryIndex) => {
            // Main row
            let highPercentage = 0;
            console.log(categoryIndex);
            if(categoryIndex == 0 ){
                highPercentage = 56;
            }else{
                highPercentage = 80;
            }
            const mainRow = `
            <tr class="text-gray-900 hover:bg-gray-100 cursor-pointer" onclick="toggleExpand(${categoryIndex})">
                <td class="border-t-0 px-4 align-middle text-sm font-bold whitespace-nowrap p-4 text-left  text-black">
                    ${category.category}
                </td>
                <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">

                    <span class="mr-2 text-xs font-medium"> ${category.percentage}%</span>
                        <div class="relative w-full ">
                            <div class="first-of-type:bg-blue-200 w-full bg-gray-200 rounded-sm h-2">
                                <div class=" h-2 rounded-sm ${category.percentage >= highPercentage ? "bg-green-700" : "bg-red-700"}" style="width:${category.percentage}%"></div>
                            </div>
                        </div>
                </td>
                <td class="border-t-0 px-4 align-middle text-xs font-medium text-center whitespace-nowrap p-4">
                    ➕
                </td>
            </tr>
            <tr id="expandable-row-${categoryIndex}" class="hidden">
                <td colspan="3" class="p-4">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-2">Fan</th>
                                    <th scope="col" class="px-4 py-2">Foiz</th>
                                    <th scope="col" class="px-4 py-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                ${category.subjects
                .map(
                    (subject, subjectIndex) => `
                                        <tr class="bg-white border-b hover:bg-gray-100 cursor-pointer" onclick="toggleLessons(${categoryIndex}, ${subjectIndex})">
                                            <td class="px-4 py-2 ">${subject.subject}</td>
                                            <td class="px-4 py-2">${subject.percentage}%</td>
                                            <td class="px-4 py-2 text-center">➕</td>
                                        </tr>
                                        <tr id="lesson-row-${categoryIndex}-${subjectIndex}" class="hidden">
                                            <td colspan="3" class="p-4">
                                                <div class="overflow-x-auto">
                                                    <table class="w-full text-sm text-left text-gray-500">
                                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                                            <tr>
                                                                <th scope="col" class="px-4 py-2">Topshiriq</th>
                                                                <th scope="col" class="px-4 py-2 ${category.className}">Holati</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            ${subject.lessons
                        .map(
                            (lesson) => `
                                                                    <tr class="bg-white border-b">
                                                                        <td class="px-4 py-2 ">${lesson.lesson}</td>
                                                                        <td class="px-4 py-2 text-${lesson.color}-700 ${category.className}">${lesson.mark}</td>
                                                                    </tr>
                                                                `
                        )
                        .join("")}
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    `
                )
                .join("")}
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            `;

            mainTable.innerHTML += mainRow;
        });

        function toggleExpand(index) {
            // Close all expandable category rows
            const allExpandableRows = document.querySelectorAll('[id^="expandable-row-"]');
            allExpandableRows.forEach((row, rowIndex) => {
                const icon = row.previousElementSibling.cells[2]; // Icon in the corresponding category row
                if (rowIndex !== index) {
                    row.classList.add("hidden");
                    if (icon) icon.textContent = "➕"; // Reset icon to plus
                }
            });

            // Toggle the clicked category row
            const clickedRow = document.getElementById(`expandable-row-${index}`);
            const clickedIcon = clickedRow.previousElementSibling.cells[2]; // Icon for the clicked row
            if (clickedRow.classList.contains("hidden")) {
                clickedRow.classList.remove("hidden");
                clickedIcon.textContent = "➖"; // Set icon to minus
            } else {
                clickedRow.classList.add("hidden");
                clickedIcon.textContent = "➕"; // Reset icon to plus
            }
        }

        function toggleLessons(categoryIndex, subjectIndex) {
            // Close all child rows within the current category
            const allLessonRows = document.querySelectorAll(`[id^="lesson-row-${categoryIndex}-"]`);
            allLessonRows.forEach((row, rowSubIndex) => {
                const icon = row.previousElementSibling.cells[2]; // Icon in the corresponding subject row
                if (rowSubIndex !== subjectIndex) {
                    row.classList.add("hidden");
                    if (icon) icon.textContent = "➕"; // Reset icon to plus
                }
            });

            // Toggle the clicked child row
            const clickedRow = document.getElementById(`lesson-row-${categoryIndex}-${subjectIndex}`);
            const clickedIcon = clickedRow.previousElementSibling.cells[2]; // Icon for the clicked subject row
            if (clickedRow.classList.contains("hidden")) {
                clickedRow.classList.remove("hidden");
                clickedIcon.textContent = "➖"; // Set icon to minus
            } else {
                clickedRow.classList.add("hidden");
                clickedIcon.textContent = "➕"; // Reset icon to plus
            }
        }
    </script>

