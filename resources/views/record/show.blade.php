@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Record Show</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                            <thead>
                            <tr>
                                <th>Student</th>
                                <td>{{ $record->student->name ?? "" }} {{ $record->student->surname ?? "" }}</td>
                            </tr>

                            <tr>
                                <th>Group</th>
                                <td>{{ $record->group->name ?? "" }}</td>
                            </tr>

                            <tr>
                                <th>Subject</th>
                                <td>{{ $record->subject->name ?? "" }}</td>
                            </tr>

                            <tr>
                                <th>Teacher</th>
                                <td>{{ $record->teacher->name ?? "" }}</td>
                            </tr>

                            <tr>
                                <th>Total Grade</th>
                                <td>{{ $record->total_current_grade }}</td>
                            </tr>

                            <tr>
                                <th>Full Grade</th>
                                <td>{{ $record->total_full_grade }}</td>
                            </tr>

                            <tr>
                                <th>Rate Percentage</th>
                                <td>{{ $record->assign_percentage }} %</td>
                            </tr>

                            <tr>
                                <th>Total Lessons</th>
                                <td>{{ $record->total_lessons }}</td>
                            </tr>

                            <tr>
                                <th>Current Lessons</th>
                                <td>{{ $record->presents }}</td>
                            </tr>

                            <tr>
                                <th>Attend Percentage</th>
                                <td>{{ $record->attend_percentage }} %</td>
                            </tr>





                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
