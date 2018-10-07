@extends('layouts.app')

	@section('content')
	<div class="container">
		<h1>{{$post->title}}</h1>//adding access control that only logged in user can access the 
		<hr>
		
		
	
		@if(!Auth::guest())

			@if(Auth::user()->id == $post->user_id)

					<a href="/app1/public/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>

			        {!!Form::open(['action' => ['Postscontroller@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
			                {{Form::hidden('_method', 'DELETE')}}
			                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
			        {!!Form::close()!!}
            @endif
        @endif    
    </div>
	@endsection
