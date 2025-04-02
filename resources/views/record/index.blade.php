@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Record Management</h3>

                        {{--@can('link-create')--}}
                        {{--<a href="{{ route('link.create') }}" class="btn btn-success btn-sm float-right">
                            <span class="fas fa-plus-circle"></span>
                            Create
                        </a>--}}
                        {{--@endcan--}}

                        {{--@can('link-filter')
                            <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                                    data-target="#employee_filter" style="margin-right: 5px">
                                <span class="fas fa-filter"></span> Filtr
                            </button>
                        @endcan--}}
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
                                <th>Rate</th>
                                <th>Attend</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <td>{{ $record->student->name ?? "" }}</td>
                                    <td>{{ $record->group->name ?? "" }}</td>
                                    <td>{{ $record->subject->name ?? "" }}</td>
                                    <td>{{ $record->teacher->name ?? "" }}</td>
                                    <td>{{ $record->assign_percentage }} %</td>
                                    <td>{{ $record->attend_percentage }} %</td>
                                    <td class="text-center">
                                        <div class="btn-group">

                                            {{--@can('link-show')--}}
                                            <a class="" href="{{ route('record.show',$record->id) }}"
                                               style="margin-right: 7px">
                                                <span class="fa fa-eye"></span>
                                            </a>
                                            {{--@endcan--}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfooter>
                                <tr>
                                    <td colspan="12">
                                        {{ $records->withQueryString()->links()   }}
                                    </td>
                                </tr>
                            </tfooter>
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
@endsection
