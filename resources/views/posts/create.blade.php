@extends('layouts.app')

@section('content')
	<h1>CREATE POSTS</h1>
	{!! Form::open(['action' => 'Postscontroller@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}

		<div class="form-group">
			{{Form::label('title','Title')}}
			{{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}
		</div>
		<div class="form-group">
			{{Form::label('body','Body')}}
			{{Form::textarea('body','',['class'=>'form-control','placeholder'=>'body text'])}}
		</div>
		<div class="form-group">
			{{Form::file('cover_image')}}
			
		</div>
			{{Form::submit('submit',['class'=>'btn btn-primary'])}}     	     	
    {!! Form::close() !!}
	
@endsection