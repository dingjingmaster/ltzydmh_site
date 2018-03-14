<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/3/14
 * Time: 22:27
 */

namespace app\index\controller;
use app\index\model\PassageContent;
use \think\Controller;
use think\Request;

class Passage extends Controller {
    public function read(Request $req) {

        $passageContent = new PassageContent();

        $res = $passageContent::get($req->param('pid'));
        echo $res['content'];

        $this->display("");
    }
}
