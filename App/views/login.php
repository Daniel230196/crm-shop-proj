<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1> Логин </h1>
<form action="<?php DEV_HOST ?>/login/auth" method="post">
    <input type="text" name="login">
    <input type="password" name="password">
    <input type="submit">
</form>

<?php
if(!is_null(\Services\SessionService::getValue('user'))):
?>
<form action="<?php DEV_HOST ?>/login/logout" method="get">
    <input type="submit" name="submit" >
</form>
</body>
</html>
<?php endif ?>