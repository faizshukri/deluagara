<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- If you delete this tag, the sky will fall on your head -->
    <meta name="viewport" content="width=device-width" />
</head>
<body>

    <p>Hi {{ $user->name }},</p>

    <p class="lead">Thanks for creating an account with Katsitu.Com.</p>

    <p>Please follow the link below to verify your email address.</p>

    <p class="callout"><a href="{{ url('register/verify/' . $user->confirmation_code) }}">{{ url('register/verify/' . $user->confirmation_code) }}</a></p>

    <p>Thanks,<br >
        katsitu.com Administrator</p>

    <p>Disclaimer:<br />
        This is an auto-generated email. Please do not reply.</p>

</body>
</html>