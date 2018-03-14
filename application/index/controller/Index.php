<?php
namespace app\index\controller;
use app\index\model\PassageInfo;
use \think\Controller;
use app\index\model\Summary;

class Index extends Controller {
    public function index() {
        $summary = new Summary();
        $passageInfo = new PassageInfo();

        $this->assign($summary->get_value());
        $this->assign($passageInfo->get_ten_passage(0));

        return $this->fetch('index');
    }
}
