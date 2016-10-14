<?php
/**
 * Created by PhpStorm.
 * User: Hoang Dang
 * Date: 9/26/2016
 * Time: 12:02 PM
 */

namespace app\UIBuilder;

class AppTemplate
{
    /**
     * Add combobox using Select2 plugin
     *
     * @param $data Collection|array has 2 column (id,name) OR Array ['id' => 'value']
     * @param array $option html attributes array ['class' => 'table table-x', 'style' => 'display:none;']
     * @return string
     */
    public static function select($data, $option = []){
        $class = 'form-control select2 ';
        if (isset($option['class'])){
            $class .= $option['class'];
            unset($option['class']);
        }

        if (isset($option['label'])){
            $html = ' <label>'.$option['label'].'</label> <select class="'. $class . '" ' ;
            unset($option['label']);
        }
        else
            $html = '<select class="'. $class . '"';

        foreach ($option as $attribute => $value){
            $html .= $attribute. '="'. $value . '" ';
        }

        $html .= '>';

        if (is_array($data) && !empty($data)){
            foreach ($data as $id => $value){
                $html .= '<option value="'. $id .'">' . $value . '</option>';
            }
        }
        else{
            foreach ($data as $item){
                $html .= '<option value="'. $item->id .'">' . $item->name . '</option>';
            }
        }

        $html .= '</select>';
        return $html;
    }

    public static function stars($rate){
        $html = '<div class="block-stars"><ul class="w3l-ratings">';
        for ($x = 0; $x < $rate; $x++) {
            $html .= '<li><i class="fa fa-star" aria-hidden="true"></i></li>';
        }
        for ($x = $rate; $x < 5; $x++) {
            $html .= '<li><i class="fa fa-star-o" aria-hidden="true"></i></li>';
        }
        $html .= '</ul></div>';

        return $html;
    }
}