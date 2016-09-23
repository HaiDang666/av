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

/**
 * make message for display on application (show by call function showNotification in JS)
 *
 * @param string $action should be Add/Create/Update/Delete/Remove
 * @param string $object
 * @param int $type      0 = fail; 1 = success; 2 = success with warning (pass in $detail);
 * @param string $detail
 * @return array
 */
function makeNotification(string $action, string $object, $type = 1, $detail = ''){
    $notification = ['mes' => '', 'code' => $type, 'detail' => $detail];

    $notification['mes'] = $action .' "'. $object.'"';
    switch ($type){
        case 0:
            $notification['mes'] .= ' fail. ';
            $notification['code'] = 0;
            break;
        case 2:
            $notification['mes'] .= ' successfully with warning. ';
            $notification['code'] = 2;
            break;
        default:
            $notification['mes'] .= ' successfully. ';
    }

    return $notification;
}