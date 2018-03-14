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
     public function get_value() {
         $res = $this::get('id');
         $passage_num = $res['passage_num'];
         $category_num = $res['category_num'];
         $comment_num = $res['comment_num'];
         $visitor_num = $res['visitor_num'];

         $res = [
             'passage'  =>      $passage_num,
             'category' =>      $category_num,
             'comment'  =>      $comment_num,
             'visitor'  =>      $visitor_num,
         ];
         return $res;
     }
 }
