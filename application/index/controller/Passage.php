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
use app\common\markdown\Parser;

class Passage extends Controller {
    public function read(Request $req) {
        $parser = new Parser;
        $passageContent = new PassageContent();

        $res = $passageContent::get($req->param('pid'));
        $html = $parser->makeHtml($res['content']);
        $this->assign([
            'content' => $html,
            'host'      =>  '' . url_type() . server_ip(),
            ]);

        return $this->fetch();
    }
}
