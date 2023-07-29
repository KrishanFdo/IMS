<!DOCTYPE html>
<html>
<head>
    <title>IMS Register Acceptence</title>
</head>

<body>

    <table>
        <tr>
            <td><b>Message:</b></td>
            <td>{{ $mail_data['message'] }}</td>
        </tr>
        <tr>
            <td><b>Username:</b></td>
            <td>{{ $mail_data['username'] }}</td>
        </tr>
        <tr>
            <td><b>Password:</b></td>
            <td>{{ $mail_data['password'] }}</td>
        </tr>

    </table>

</body>

</html>
