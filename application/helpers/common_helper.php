<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 01/04/2020
 * Time: 16:14
 */


if (!function_exists("display_message")) {
    function display_message($message, $message_type = "success")
    {
        if ($message_type == "success") {
            return '<div class="alert alert-success">' . $message . '</div>';
        }

        if ($message_type == "info") {
            return '<div class="alert alert-info">' . $message . '</div>';
        }

        if ($message_type == "warning") {
            return '<div class="alert alert-warning">' . $message . '</div>';
        }

        if ($message_type == "danger") {
            return '<div class="alert alert-danger">' . $message . '</div>';
        }
    }
}


if (!function_exists("get_current_user_id")) {
    function get_current_user_id()
    {
        $CI = &get_instance();
        return $CI->session->userdata("user_id");
    }
}

//display current user name
if (!function_exists('get_current_user_name')) {
    function get_current_user_name()
    {
        $CI = &get_instance();

        $user_id = $CI->session->userdata('user_id');
        $user = $CI->user_model->get_by(['id' => $user_id]);

        if ($user) {
            return ucfirst($user->first_name) . ' ' . ucfirst($user->last_name);
        } else {
            return '';
        }
    }
}

//show percentage
if (!function_exists('calc_percentage')) {
    function calc_percentage($num, $total)
    {
        $percent = 0;
        if ($total > 0) {
            $percent = ($num / $total) * 100;

            if ($percent > 0) {
                if ($percent > 100)
                    return 100;
                else
                    return round($percent, 1);
            } else {
                return $percent;
            }
        } else {
            return $percent;
        }
    }
}
