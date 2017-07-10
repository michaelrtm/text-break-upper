@foreach($newText as $text)
    @foreach($text as $chunk)
        <p>{{ $chunk }}</p>
    @endforeach
    <hr></hr>
@endforeach