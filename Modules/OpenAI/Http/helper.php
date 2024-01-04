<?php


if (!function_exists('askTheQuestion')) {
    /**
     * Generate random string
     * @param int $length
     * @return string
     */
    function askTheQuestion($length = 5)
    {
        return substr(str_shuffle('examghfgh786868plestringletsgo'), 0, $length);
    }
}






