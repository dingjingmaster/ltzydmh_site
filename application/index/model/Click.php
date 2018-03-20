<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/3/15
 * Time: 22:44
 */

namespace app\index\model;
use \think\Model;

class Click extends Model {
    protected  $table = "ltzydmh_click";
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
}