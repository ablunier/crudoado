@extends('adoadomin::layouts.master')

@section('content-header')
<h1>
    {{ $abstractor->getName() }}
    <small>Create</small>
</h1>
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-database"></i> CRUDoado</a></li>
    <li><a href="#">ModelName</a></li>
    <li class="active">Create</li>
</ol>
@stop

@section('content')
<div class="box">
    <form class="form-horizontal">
        <div class="box-header">
            <div class="box-title">
                <a href="{{ URL::previous() }}"><i class="fa fa-arrow-left"></i> {{ trans('crudoado::messages.back_button') }}</a>
            </div>
            <div class="box-tools">
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> {{ trans('crudoado::messages.save_button') }}</button>
            </div>
        </div>

        <div class="box-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input class="form-control" id="inputEmail3" placeholder="Email" type="email">
                </div>
            </div>
        </div>

        <div class="box-footer clearfix">
            <a href="#" class="btn btn-default">{{ trans('crudoado::messages.cancel_button') }}</a>
            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> {{ trans('crudoado::messages.save_button') }}</button>
        </div>
    </form>
</div>
@stop