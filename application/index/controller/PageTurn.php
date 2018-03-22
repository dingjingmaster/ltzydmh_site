<?php
/**
 * Created by PhpStorm.
 * User: DingJing
 * Date: 2018/3/22
 * Time: 14:29
 */

namespace app\index\controller;
use think\Request;
use \think\Controller;
use app\index\model\Summary;
use app\index\model\PassageInfo;


class PageTurn extends Controller {
    public function page(Request $req) {
        $response = [];
        $categoryNum = 0;                                               // 分类数
        $commentNum = 0;                                                // 评论数
        $startPassage = 0;                                              // 请求文章开始
        $totalPassage = 0;                                              // 数据库中文章总数
        $showPage = 6;                                                  // 每次展示的页数 1,2,3,4,5
        $everyPageNum = 16;                                             // 每页展示条数
        $curPage = 0;                                                   // 当前第几页

        $mainContent = '';                                              // 主页展示
        $splitPageContent = '';                                         // 分页展示

        update_click_num();
        $summary = new Summary();
        $passageInfo = new PassageInfo();

        /* 侧边栏信息 */
        $res = $summary::get('id');
        $totalPassage = $res['passage_num'];
        $categoryNum = $res['category_num'];
        $commentNum = $res['comment_num'];

        /* 主页展示及分页 */
        $res = $passageInfo->limit($startPassage, $everyPageNum)->select();
        $mainContent = index_passage_html($res);
        $splitPageContent = page_slip($curPage, $totalPassage, $showPage, $everyPageNum);

        $response = [
            /* 侧边栏展示 */
            'passage'           =>      $totalPassage,
            'category'          =>      $categoryNum,
            'comment'           =>      $commentNum,
            /* 主页展示 */
            'content'           =>      $mainContent,
            /* host */
            'host'              =>      url_type() . server_ip(),
            /* 分页 */
            'pageContent'       =>      $splitPageContent,
        ];

        $this->assign($response);
        return $this->fetch('index');
    }
}