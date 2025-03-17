@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Student</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::model($student, ['method' => 'PATCH','route' => ['student.update', $student->id]]) !!}
                        <div class="row">

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="name"><strong>Name:</strong></label>
                                    {!! Form::text('name', null, ['autocomplete'=>'OFF','id'=>'name','placeholder' => 'Name','required'=>true,'class' => "form-control ".($errors->has('name') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('name'))
                                        <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="surname"><strong>Surname:</strong></label>
                                    {!! Form::text('surname', null, ['autocomplete'=>'OFF','id'=>'surname','placeholder' => 'Surname','required'=>true,'class' => "form-control ".($errors->has('surname') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('surname'))
                                        <span class="error invalid-feedback">{{ $errors->first('surname') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="phone"><strong>Phone:</strong></label>
                                    {!! Form::text('phone', null, ['autocomplete'=>'OFF','id'=>'phone','placeholder' => 'Phone','class' => "form-control ".($errors->has('phone') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('phone'))
                                        <span class="error invalid-feedback">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="parent_phone"><strong>Parent Phone:</strong></label>
                                    {!! Form::text('parent_phone', null, ['autocomplete'=>'OFF','id'=>'parent_phone','placeholder' => 'Parent Phone','class' => "form-control ".($errors->has('parent_phone') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('parent_phone'))
                                        <span class="error invalid-feedback">{{ $errors->first('parent_phone') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="is_sms"><strong>Is Sms:</strong></label>
                                    {!! Form::select('is_sms', \App\Models\Student::$is_sms,null, ['autocomplete'=>'OFF','id'=>'is_sms','class' => "form-control ".($errors->has('is_sms') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('is_sms'))
                                        <span class="error invalid-feedback">{{ $errors->first('is_sms') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="status"><strong>Status:</strong></label>
                                    {!! Form::select('status', \App\Models\Student::$statuses,null, ['autocomplete'=>'OFF','id'=>'status','required'=>true,'class' => "form-control ".($errors->has('status') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('status'))
                                        <span class="error invalid-feedback">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <br>
                                <button type="submit" class="btn btn-primary form-control">Edit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
