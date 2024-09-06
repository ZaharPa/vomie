<?php
namespace scripts\interface;

interface User
{
    public function set_name($link, $email);
    public function get_name();
    public function set_role($link, $email);
    public function get_role();
    public function login_user($link, $email, $password);
    public function reg_user($link, $email, $password, $email);
    public function change_photo($link, $path, $photoName);
    public function set_name_image($link, $email);
    public function change_role($link, $email);
    public function delete_user($link, $email);
    public function change_name($link, $email);
    public function change_password($link, $email);
}
