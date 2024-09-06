<?php
namespace scripts\class;

use scripts\interface\User;

class Viewer implements User
{

    public function change_password($link, $email)
    {}

    public function set_name($link, $email)
    {}

    public function login_user($link, $email, $password)
    {}

    public function change_role($link, $email)
    {}

    public function change_name($link, $email)
    {}

    public function reg_user($link, $email, $password, $email)
    {}

    public function get_name()
    {}

    public function set_role($link, $email)
    {}

    public function set_name_image($link, $email)
    {}

    public function delete_user($link, $email)
    {}

    public function change_photo($link, $path, $photoName)
    {}

    public function get_role()
    {}
}

