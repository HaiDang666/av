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
 * @param $action string should be Add/Create/Update/Delete/Remove
 * @param $object
 * @param $type   int    0 = fail; 1 = success; 2 = success with warning (pass in $detail);
 * @param $detail string
 * @return array
 */
function makeNotification($action, $object, $type = 1, $detail = ''){
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

/**
 * add exception case for unique rule validation
 *
 * @param $fields array list of unique attribute
 * @param $id
 * @return array
 */
function addExceptionUniqueRule($fields, $id){
    $result = [];
    foreach ($fields as $field){
        $result[$field] = $id;
    }

    return $result;
}

/**
 * Store image in storage folder
 *
 * @param $imageFile
 * @param $imageName
 * @param $keyPath string key for storage path in config file
 * @return string image's name
 * @throws Exception
 */
function storeImage($imageFile, $imageName, $keyPath){
    try{
        $imageName = str_replace(' ', '_', $imageName).'.'.
            $imageFile->getClientOriginalExtension();

        $imageFile->move(
            base_path() . '/storage/'. config($keyPath), $imageName
        );
    }catch (\Exception $e){
        throw $e;
    }

    return $imageName;
}