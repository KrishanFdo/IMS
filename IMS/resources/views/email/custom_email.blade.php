<!DOCTYPE html>
<html>
<head>
    <title>Custom Email</title>
</head>

<body>

    <table>
        <tr>
            <td>
                <p>
                    Dear All,<br>
                    {{ $mail_data['content'] }}<br>
                    Thank You Best Regards!
                </p>
            </td>

        </tr>
    </table>

</body>

</html>
