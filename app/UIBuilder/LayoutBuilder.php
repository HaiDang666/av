<?php
/**
 * Created by PhpStorm.
 * User: Hoang Dang
 * Date: 9/13/2016
 * Time: 3:56 PM
 */

namespace App\UIBuilder;

class LayoutBuilder
{
    public static function makeSideBar(){
        $headerList = getAVAppConfig('sidebarMenu.admin');

        $htmlEntity = '<ul class="sidebar-menu">';
        foreach ($headerList as $header => $links){
            $htmlEntity .= '<li class="header">' . $header . '</li>';

            foreach ($links as $text => $content){
                if (array_key_exists('route', $content)){
                    $htmlEntity .= '<li><a href='. url($content['route']) .'><i class="fa fa-link"></i><span>'. $text .'</span></a></li>';
                }

                if (array_key_exists('submenu', $content)){
                    $htmlEntity .= '<li class="treeview hover-active">'.
                                   '<a href="#"><i class="fa fa-link"></i> <span>'. $text .'</span> <i class="fa fa-angle-left pull-right"></i></a>'.
                                   '<ul class="treeview-menu">';

                    foreach ($content['submenu'] as $subtext => $subcontent) {
                        $htmlEntity .= '<li><a href=' . url(str_replace('.', '/', $subcontent['route'])) . '>'. $subtext .'</a></li>';
                    }
                    $htmlEntity .= '</ul></li>';
                }
            }
        }

        $htmlEntity .= '</ul>';
        return $htmlEntity;
    }
}