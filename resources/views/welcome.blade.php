<!DOCTYPE html>
<html>
<head>
    <title>Text Break Upper</title>
</head>
<body>
    <form method="POST" action="/break">
        {{ csrf_field() }}
        <input type="text" name="count" placeholder="Size of chunks">
        <textarea name="text" placeholder="The text to be broken up"></textarea>
        <button type="submit">
            Break it up!!
        </button>
    </form>
</body>
</html>