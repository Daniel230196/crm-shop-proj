<?php


namespace App\Views;


class LoginView extends View
{

    public function renderTemplate()
    {
        include static::TEMP_PATH . 'login.php';
    }

}