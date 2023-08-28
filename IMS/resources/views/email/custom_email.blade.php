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
                    Dear {{ $mail_data['user']->fname }},<br>
                    {{ $mail_data['content'] }}<br>
                    Thank You Best Regards!
                </p>
            </td>

        </tr>
    </table><br><br>

    <p><?php echo "Please Don't reply to this email"; ?></p>

</body>

</html>
