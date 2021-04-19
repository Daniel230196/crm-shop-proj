<?php


namespace App\Views;


class LoginView extends View
{

    public function template()
    {
        include static::TEMP_PATH . 'login.php';
    }

}