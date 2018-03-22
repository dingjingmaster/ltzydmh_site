<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/3/13
 * Time: 22:25
 */

 namespace app\index\model;
 use \think\Model;

 class Summary extends Model {
     protected  $table = "ltzydmh_summary";
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
