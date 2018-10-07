@extends('layouts.app')

@section('content')
        <h1>{{$title}}</h1>
        <p>this is the <strong>services</strong> page
@if(count($services) > 0)            
            
            <ul class="list-group">
                @foreach($services as $a)
                <li class="list-group-item">{{$a}}</li>
                @endforeach
            </ul>
@endif
        </p>

@endsection
       
