
<div class="container col-md-4 ">
<h1> Логин </h1>
<form action="<?php DEV_HOST ?>/login/auth" method="post">
    <input class="form-control form-control-md" type="text" placeholder="login" aria-label="Login" name="login">
    <input type="password" class="form-control form-control-md" placeholder="password" aria-label="Password">
    <button class="btn btn-primary col-sm-3"> Test </button>
</form>
</div>
<?php
if(!is_null(\Services\SessionService::getValue('user'))):
?>
<form action="<?php DEV_HOST ?>/login/logout" method="get">
    <input type="submit" name="submit" >
</form>
<?php endif ?>