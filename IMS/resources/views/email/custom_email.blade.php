<!DOCTYPE html>
<html>
<head>
    <title>Alumna-DCS | Email</title>
</head>

<body>

    <table>
        <tr>
            <td>
                <p>
                    Dear {{ $mail_data['user']->fname }},<br>
                    {!! nl2br($mail_data['content']) !!}<br>
                    Thank You Best Regards!
                </p>
            </td>

        </tr>
    </table><br><br>

    <p><?php echo "Please Don't reply to this email"; ?></p>

</body>

</html>
