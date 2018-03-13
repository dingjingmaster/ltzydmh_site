<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/3/13
 * Time: 22:25
 */

 namespace app\index\controller;

 class Index extends \think\Controller
 {
     public function index()
     {
         $this ->assign('title', "末班测试");
         return $this->fetch('index');
     }
 }