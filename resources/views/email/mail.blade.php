<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    @lang('lang.hello') <strong>{{$name}} !</strong>
    <p>@lang('lang.msg_welcome')</p>
    
    {!! $body !!}
    <!-- quand on fait les point dexclamation on doit mettre juste une curly bracket -->
</body>
</html>