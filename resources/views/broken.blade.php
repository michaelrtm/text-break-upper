@extends('layout')

@section('content')
    <div class="alert alert-success">
        <b>Woo!</b> You can grab the text file <a href="{{ $textFile }}">here</a>. It won't hang around long!
    </div>
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