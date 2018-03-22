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
use app\index\model\PassageInfo;

class Passage extends Controller {
    public function read(Request $req) {
        $parser = new Parser;
        $passageContent = new PassageContent();
        $passageInfo = new PassageInfo();
        $pid = $req->param('pid');

        $res = $passageContent::get($pid);
        $html = $parser->makeHtml($res['content']);
        $this->assign([
            'content'   =>      $html,
            'keyword'   =>      $res['keyword'],
            'host'      =>      '' . url_type() . server_ip(),
            ]);
        update_click_num();
        $passageInfo->update_view($pid);
        return $this->fetch();
    }
}
