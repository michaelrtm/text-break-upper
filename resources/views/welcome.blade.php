@extends('layout')

@section('content')
    <div class="alert alert-success">Any text you enter will be delimted by semicolons (;) and will be broken into the length specified by "Chunks"</div>
    <form method="POST" action="/break">
        {{ csrf_field() }}
        <div class="form-group">
            <input class="form-control" type="text" name="count" placeholder="Size of chunks">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="text" placeholder="The text to be broken up"></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-block btn-primary" type="submit">
                Break it up!!
            </button>
        </div>
    </form>
@stop