<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- If you delete this tag, the sky will fall on your head -->
    <meta name="viewport" content="width=device-width" />

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>ZURBemails</title>

    <style>
        {{ file_get_contents('css/email.css') }}
    </style>
    {{--<link rel="stylesheet" type="text/css" href="css/email.css" />--}}

</head>
<body>
    <!-- HEADER -->
    <table class="head-wrap" bgcolor="#999999">
        <tr>
            <td></td>
            <td class="header container" >

                <div class="content">
                    <table bgcolor="#999999">
                        <tr>
                            <td><img src="http://placehold.it/200x50/" /></td>
                            <td align="right"></td>
                        </tr>
                    </table>
                </div>

            </td>
            <td></td>
        </tr>
    </table><!-- /HEADER -->

    @yield('email_body')

    <!-- FOOTER -->
    <table class="footer-wrap">
        <tr>
            <td></td>
            <td class="container">

                <!-- content -->
                <div class="content">
                    <table>
                        <tr>
                            <td align="center">
                                <p>
                                    <a href="#">Terms</a> |
                                    <a href="#">Privacy</a> |
                                    <a href="#"><unsubscribe>Unsubscribe</unsubscribe></a>
                                </p>
                            </td>
                        </tr>
                    </table>
                </div><!-- /content -->

            </td>
            <td></td>
        </tr>
    </table><!-- /FOOTER -->
</body>
</html>