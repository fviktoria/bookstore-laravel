<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Test view</title>
</head>
<body>
<h1>Hello {{$firstName}} {{$lastName}}</h1>

<ul>
    @foreach ($books as $b)
        <li>{{$b}}</li>
    @endforeach
</ul>
</body>
</html>