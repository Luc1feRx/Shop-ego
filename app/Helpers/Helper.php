<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helper{
    public function category($getList, $parent_id = 0, $char = ''){
        $html = '';
        foreach ($getList as $key => $cate){
            if($cate->parent_id == $parent_id){
                $html .= '
                <tr>
                    <td>'. $cate->id .'</td>
                    <td>'. $char . $cate->category_name .'</td>
                    <td>'. self::active($cate->active) .'</td>
                    <td>'. $cate->updated_at .'</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="edit/' . $cate->id . '"><i class="fas fa-edit"></i></a>
                        <a onclick="DeleteRow(' . $cate->id. ', \'delete\')" class="btn btn-danger btn-sm" href="#"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                ';
                unset($getList[$key]);

                $html .= self::category($getList, $cate->id, $cate->category_name.' - ');
            }
        }
        return $html;
    }

    public function active($active){
        return $active == 0 ? '<a href=""><span><i style="font-size: 23px; color: red;" class="fa fa-thumbs-down"></i></span></a>' : '<a href=""><span><i style="font-size: 23px; color: green;" class="fa fa-thumbs-up"></i></span></a>';
    }

    public static function categories($category, $parent_id = 0) {
        $html = '';
        foreach ($category as $key => $value) {
            if($value->parent_id == $parent_id){
                $url = route('cate-home', ['id' => $value->id, 'slug' => Str::slug($value->category_name, '-')]);
                $html .= '
                    <li>
                        <a href="'. $url .'">
                            '. $value->category_name .'
                        </a>';

                        if(self::isChild($category, $value->id) == true){
                            $html .= '<ul class="sub-menu">';
                            $html .= self::categories($category, $value->id);
                            $html .= '</ul>';
                        }

                   $html .= ' </li>';
            }
        }
        return $html;
    }

    public static function isChild($category, $id){
        foreach($category as $v){
            if($v->parent_id == $id){
                return true;
            }
        }
        return false;
    }

    public function getPrice($price = 0, $priceSale = 0){
        if($priceSale != 0){
            return number_format($priceSale);
        }
        if($price != 0){
            return number_format($price);
        }
        return '<a href="contract.html">Liên Hệ</a>';
    }

}
