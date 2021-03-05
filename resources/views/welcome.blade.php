<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Test view</title>
</head>
<body>

<ul>
    @foreach ($books as $book)
        <li>{{$book->isbn}}: {{$book->title}}</li>
    @endforeach
</ul>
</body>
</html>