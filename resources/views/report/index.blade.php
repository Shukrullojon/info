@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Report Management</h3>
                        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#report_filter" style="margin-right: 5px">
                            <span class="fas fa-filter"></span> Filter
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <!-- Data table -->
                        <table id="dataTable"
                               class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg"
                               user="grid" aria-describedby="dataTable_info">
                            <thead>
                            <tr>
                                <th>Student</th>
                                <th>Group</th>
                                <th>Subject</th>
                                <th>Teacher</th>
                                <th>Attendances</th>
                                <th>Grade</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if($report)
                                    <tr>
                                        <td>{{ $report->StudentNumber }}</td>
                                        <td>{{ $report->GroupsNumber }}</td>
                                        <td>{{ $report->SubjectNumber }}</td>
                                        <td>{{ $report->TeacherNumber }}</td>
                                        <td>{{ round($report->AverageAttendPercentage) }} %</td>
                                        <td>{{ round($report->AverageAssignPercentage) }} %</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

    <div class="modal fade" id="report_filter">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Filter</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['method'=>'GET']) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Group:</strong>
                                {!! Form::select('group_id[]', $groups, request()->get('group_id'), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Subject:</strong>
                                {!! Form::select('subject_id[]', $subjects, request()->get('subject_id'), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Teacher:</strong>
                                {!! Form::select('teacher_id[]', $teachers, request()->get('teacher_id'), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Attend:</strong>
                                {!! Form::text('attend', request()->get('attend'), ['placeholder' => 'Attend','class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Assign:</strong>
                                {!! Form::text('assign', request()->get('assign'), ['placeholder' => 'Assign','class' => 'form-control']) !!}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a class="btn btn-default" href="{{ route("report.index") }}">Clear</a>
                    <button type="submit" name="submit" class="btn btn-primary">Filter</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection


