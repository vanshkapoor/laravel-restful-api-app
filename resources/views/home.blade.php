@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if(count($posts) > 0)
                    <table class="table table-striped">
                        <tr>
                            <th>TITLE</th>
                            <th></th>
                            <th></th>
                        </tr>
                    
                    @foreach($posts as $post)
                    
                        <tr>
                            <td>{{$post->title}}</td>
                            <td><a href="/app1/public/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                            <td>
                                {!!Form::open(['action' => ['Postscontroller@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                            {!!Form::close()!!}

                            </td>
                        </tr>
                    @endforeach    
                    </table>
                    @else
                        <h1>you have no posts</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
