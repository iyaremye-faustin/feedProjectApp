<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Created Notification</title>
</head>
<body>
    <div class="container">
        <div class="main">
            <p>Dear <span>{{ $name }}</span>, The account to <span>{{ config('app.name') }}</span> has been created.</p>
            <p>Login with you email and <span>{{ $defaultPassword }}</span> as password, this password should be changed immediately after login.</p>
            <p>Regards!</p>
        </div>
    </div>
</body>
</html>
