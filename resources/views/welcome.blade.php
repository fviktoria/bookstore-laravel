<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Test view</title>
</head>
<body>
<h1>Hello <?php echo $firstName . ' ' . $lastName; ?></h1>
</body>
</html>