@extends('layouts.app')

@section('content')
	<h1>POSTS</h1>
	@if(count($posts)>0)
		@foreach($posts as $post)
		<div class="container">
			<div class="well">
				<div class="col-md-4 col-sm-4">
					<img src="storage/cover_images/{{$post->cover_image}}">
				</div>
				<div class="col-md-8 col-sm-8">
				<h3><a href="/app1/public/posts/{{$post->id}}">{{$post->title}}</a></h3>	
				</div>
				
			</div>
		</div>
		@endforeach
		{{ $posts->links() }}
	@else
		<p>no content</p>
	@endif
@endsection