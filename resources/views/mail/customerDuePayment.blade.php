<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Milk Kitchen</title>
</head>

<body>
    <table width="600" border="0" cellspacing="0" cellpadding="0" style="background:#ebebeb;">
        <tr>
            <td style="padding:20px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center" style="background-color:#000;"><a href="http://kumbie.com/"
                                target="_blank"><img src="{{ asset('images/logo.png') }}" style="border:none;"
                                    alt="" /></a></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left"
                            style="background:#fff; padding:20px; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:25px;">

                            <table cellpadding="3" cellspacing="10" class="table table-striped">
                                <thead>
                                    <tr>
                                        <td class="right">Customer</td>
                                        <td class="center">Statement Amount</td>
                                    </tr>
                                </thead>
                                <tbody>
                                 
                                       <td>{{$data["name"]}}</td>
                                       <td>{{$data["price"]}}</td>
                            
                                </tbody>
                            </table>
                    </tr>
                    <tr>
                        <td align="center" valign="top"><a href="http://facebook.com/" target="_blank"><img
                                    src="{{ asset('images/navigation_shadow.png') }}" style="border:none" width="600"
                                    height="10" alt="" /></a></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td height="10"></td>
                    </tr>
                    <tr>
                        <td
                            style="background:#000; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:16px;">
                            <table width="100%" border="0" cellspacing="2" cellpadding="2">
                                <tr>
                                    <td width="81%" align="left">
                                        <table border="0" cellspacing="2" cellpadding="2" width="191">
                                            <tr>
                                                <td width="26" align="left" valign="middle"><img
                                                        src="{{ asset('images/1395931032_home.png') }}"
                                                        name="_x0000_i1025" width="16" height="16" border="0"
                                                        id="_x0000_i1025" /></td>
                                                <td width="154" align="left" valign="middle"><a href="www.kumbie.com"
                                                        target="_blank" style="color:#fff">www.milkkitchen.co</a></td>
                                            </tr>
                                            <tr>
                                                <td width="26" align="left" valign="middle"><img
                                                        src="{{ asset('images/1395931068_Black_Email.png') }}"
                                                        alt="Email:" name="_x0000_i1026" width="20" height="13"
                                                        border="0" id="_x0000_i1026" /></td>
                                                <td width="154" align="left" valign="middle"><a
                                                        href="mailto:support@kumbie.com" target="_blank"
                                                        style="color:#fff">info@</a><a href="www.kumbie.com"
                                                        target="_blank" style="color:#fff">milkkitchen.co</a></td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" style="font-family:Arial; font-size:12px; color:#000;">Copyright © 2021 ©
                            milk kitchen L:td All rights reserved

                            <br />
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

    <style>
        .table-striped {
            border: solid 1px #ddd;
        }
        .table-striped thead {
            border: solid 1px #ddd;
            height: 40px;
            font-weight: bold;
            color: #000;
        }
        .table-striped tr {
            border: solid 0px #ddd;
        }
        .table-striped td {
            border: solid 1px #ddd;
            padding: 10px;
        }
    </style>

</body>

</html>