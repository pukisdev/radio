@extends('templates.layouts.gentalella')
@section('content')
    i am the home page
    {!! Form::label('name', @$name) !!}

		<input type="text" ng-model="nama"/> <br/>
		Nama : @{{ nama }} <br/>
	
@stop  