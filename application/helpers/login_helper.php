<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('CheckLogin'))
{
    function CheckAkses($role = "")
    {
        $ci =& get_instance();
        $authorized = false;
        $user = $ci->session->userdata("userinfo");

        if($user) $authorized = ($role == $user["type"]);

        return $authorized;
    }

    function CheckAksesGroup($role)   
    {
        $ci =& get_instance();
        $authorized = false;
        $user = $ci->session->userdata("userinfo");

        if($user) $authorized = (in_array($user["type"], $role));

        return $authorized;
    }

}