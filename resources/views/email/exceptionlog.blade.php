<!DOCTYPE html>
<html>
<head>
    <title>Log</title>
</head>
<body>
    <h2>Error Log</h2>
    <p>{{ $currentUser->username or '' }} {{ \Request::getMethod() }} {{ \Request::getUri() }}</p>
    <p>{{ $browser->Browser }} {{ $browser->Version }} at {{ $browser->Platform }} ({{ $browser->Device_Type }})</p>
    {!! nl2br($error) !!}
</body>
</html>