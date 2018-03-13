<?php
namespace app\index\controller;

class Index extends \think\Controller
{
    public function index()
    {
        $this ->assign('title', "末班测试");
        return $this->fetch('index');
    }
}
