@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Link Management</h3>

                        {{--@can('link-create')--}}
                            <a href="{{ route('link.create') }}" class="btn btn-success btn-sm float-right">
                                <span class="fas fa-plus-circle"></span>
                                Create
                            </a>
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
                                <th>Link</th>
                                <th>Info</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($links as $link)
                                <tr>
                                    <td>{{ substr($link->link,0,50) }}</td>
                                    <td>{{ $link->info }}</td>
                                    <td>{{ \App\Models\Link::$types[$link->type] ?? "No Found" }}</td>
                                    <td>{{ \App\Models\Link::$statuses[$link->status] ?? "No Found" }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">

                                            {{--@can('link-show')--}}
                                                <a class="" href="{{ route('link.show',$link->id) }}"
                                                   style="margin-right: 7px">
                                                    <span class="fa fa-eye"></span>
                                                </a>
                                            {{--@endcan--}}

                                            {{--@can('department-edit')--}}
                                                <a class="" href="{{ route('link.edit',$link->id) }}" style="margin-right: 2px">
                                                    <span class="fa fa-edit" style="color: #562bb0"></span>
                                                </a>
                                            {{--@endcan--}}

                                            {{--@can('link-destroy')--}}
                                                <form action="{{ route("link.destroy", $link->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="button"
                                                            style='display:inline; border:none; background: none'
                                                            onclick="if (confirm('Вы уверены?')) { this.form.submit() } "><span
                                                            class="fa fa-trash"></span></button>
                                                </form>
                                            {{--@endcan--}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfooter>
                                <tr>
                                    <td colspan="12">
                                        {{ $links->withQueryString()->links()   }}
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
