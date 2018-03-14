<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/3/14
 * Time: 22:32
 */

namespace app\index\model;
use \think\Model;

class PassageContent extends Model {
    protected  $table = "ltzydmh_passage_content";
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