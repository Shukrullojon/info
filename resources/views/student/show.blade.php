@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Student Show</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <td>{{ $student->name }}</td>
                            </tr>

                            <tr>
                                <th>Surname</th>
                                <td>{{ $student->surname }}</td>
                            </tr>

                            <tr>
                                <th>Jdu Id</th>
                                <td>{{ $student->jdu_id }}</td>
                            </tr>

                            <tr>
                                <th>Phone</th>
                                <td>{{ $student->phone }}</td>
                            </tr>

                            <tr>
                                <th>Parent Phone</th>
                                <td>{{ $student->parent_phone }}</td>
                            </tr>

                            <tr>
                                <th>Score</th>
                                <td>{{ $student->total_score }} %</td>
                            </tr>

                            <tr>
                                <th>Attend</th>
                                <td>{{ $student->total_attendance }} %</td>
                            </tr>

                            <tr>
                                <th>Is Sms</th>
                                <td>{{ $student->is_sms }}</td>
                            </tr>

                            <tr>
                                <th>Is Send</th>
                                <td>{{ $student->is_send }}</td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td>{{ \App\Models\Student::$statuses[$student->status] }}</td>
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
