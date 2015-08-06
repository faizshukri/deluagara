<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!-- If you delete this tag, the sky will fall on your head -->
        <meta name="viewport" content="width=device-width" />
    </head>
    <body>

        <p>Hi {{ $user->name }},</p>

        <p>To reset the password please click the following link -</p>

        <p><a href="{{ url('resetpassword/' . $user->resetPassword->reset_token) }}">{{ url('resetpassword/' . $user->resetPassword->reset_token) }}</a></p>

        <p>Kindly ignore this email if this process was not initiated from your end.</p>

        <p>Note:<br />
        This link will only valid for 3 days.</p>


        <p>Thanks,<br >
        katsitu.com Administrator</p>

        <p>Disclaimer:<br />
        This is an auto-generated email. Please do not reply.</p>

    </body>
</html>