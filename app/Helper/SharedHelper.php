<?php
namespace App\Helper;

use Illuminate\Support\Collection;

class SharedHelper
{  
  /**
   * getChild
   *
   * @param  string $value
   * @param  int $key
   * @param  array $data
   * @return array
   */
  public static function getChild($value, $key, $data) 
  {
    $res = [];
    foreach ($data as $k=>$v) {
      if ($v->$key == $value) {
        $res[] = $data[$k];
      }
    }

    return $res;
  }
  
  /**
   * getParent
   *
   * @param  int $key
   * @param  array $data
   * @return array
   */
  public static function getParent($key, $data) 
  {
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

    
  /**
   * searchArrayByValue
   *
   * @param  array $array 
   * @param  string $key
   * @param  string $keyword
   * @return array
   */
  public static function searchArrayByValue($array, $key, $keyword)
  {
    $position =  array_search($keyword, array_column($array, $key));
  
    return $array[$position];
  }
}