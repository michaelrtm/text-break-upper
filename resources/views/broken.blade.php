@extends('layout')

@section('content')
    @foreach($newText as $text)
        <div class="panel panel-default">
            <div class="panel-heading"></div>
            <div class="panel-body">
                @foreach($text as $chunk)
                       <p class="spacious">{{ $chunk }}</p>
                @endforeach
            </div>
        </div>
    @endforeach
@stop