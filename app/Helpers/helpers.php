<?php
/**
 * Created by PhpStorm.
 * User: Hoang Dang
 * Date: 9/14/2016
 * Time: 3:22 PM
 */

/**
 * Conventional function to get AV configurations
 *
 * @param  string $key     File name (dot) key
 * @param  mixed  $default The return value if key not found
 * @return mixed
 */
function getAVAppConfig($key, $default = NULL){
    return config('website.' . $key, $default);
}