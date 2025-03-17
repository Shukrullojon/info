@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create new link</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'link.store','method'=>'POST']) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="link"><strong>Link:</strong></label>{!! Form::label('link',"*",['style'=>"color:red"]) !!}
                                    {!! Form::text('link', null, ['autocomplete'=>'OFF','id'=>'link','placeholder' => 'Link','required'=>true,'class' => "form-control ".($errors->has('link') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('link'))
                                        <span class="error invalid-feedback">{{ $errors->first('link') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="info"><strong>Info:</strong></label>
                                    {!! Form::text('info', null, ['autocomplete'=>'OFF','id'=>'info','placeholder' => 'Info','class' => "form-control ".($errors->has('info') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('info'))
                                        <span class="error invalid-feedback">{{ $errors->first('info') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="type"><strong>Type:</strong></label>{!! Form::label('type',"*",['style'=>"color:red"]) !!}
                                    {!! Form::select('type', \App\Models\Link::$types,null, ['autocomplete'=>'OFF','id'=>'type','required'=>true,'class' => "form-control ".($errors->has('type') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('type'))
                                        <span class="error invalid-feedback">{{ $errors->first('type') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="status"><strong>Status:</strong></label>{!! Form::label('type',"*",['style'=>"color:red"]) !!}
                                    {!! Form::select('status', \App\Models\Link::$statuses,null, ['autocomplete'=>'OFF','id'=>'status','required'=>true,'class' => "form-control ".($errors->has('status') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('status'))
                                        <span class="error invalid-feedback">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <br>
                                <button type="submit" class="btn btn-primary form-control">Save</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
