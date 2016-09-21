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

function makeNotification($action, $object, $type = 1, $detail = ''){
    $notification = ['mes' => '', 'code' => $type, 'detail' => $detail];

    switch ($action){
        case 'update':
            $notification['mes'] = 'Updated '. $object; break;
        case 'delete':
            $notification['mes'] = 'Deleted '. $object; break;
        default:
            $notification['mes'] = 'Added '. $object;
    }

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