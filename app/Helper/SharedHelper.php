<?php
namespace App\Helper;

use Illuminate\Support\Collection;

class SharedHelper
{
  public static function getChild($value, $key, $data) {
    $res = [];
    foreach ($data as $k=>$v) {
      if ($v->$key == $value) {
        $res[] = $data[$k];
      }
    }

    return $res;
  }

  public static function getParent($key, $data) {
    $res = [];
    foreach ($data as $k=>$v) {
      if ($v->$key > 0) {
        $res[] = $data[$k]->$key;
      }
    }
    $collection = collect($res);
    $unique = $collection->unique();
    
    return $unique->values()->all();
  }
}