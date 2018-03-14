<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/3/14
 * Time: 9:35
 */

namespace app\index\model;
use \think\Model;

class PassageInfo extends Model {
    protected  $table = "ltzydmh_passage_info";
    protected $connection = [
        'type'         =>      'mysql',
        'hostname'     =>      '127.0.0.1',
        'database'     =>      'ltzydmh',
        'username'     =>      'root',
        'password'     =>      'root',
        'charset'      =>      'utf8',
        'prefix'       =>      '',
        'debug'        =>      true,
    ];

    public function get_ten_passage($start) {
        $res = '';
        try {
            $data = $this->limit($start, 10)->select();
            $res = index_passage_html($data);
        }catch (\mysqli_sql_exception $e) {
            $e->getMessage();
        }
        $res = [
          'content'     =>      $res,
        ];

        return $res;
    }
}