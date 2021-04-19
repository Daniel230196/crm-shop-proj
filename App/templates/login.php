
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
<?php endif ?>