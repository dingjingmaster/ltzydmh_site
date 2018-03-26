<?php

use app\index\model\Click;

/* 分页功能 */
/**
 *  @$curPage:          当前页数
 *  @$totalNum:         总条数
 *  @$showPage:         一次显示页数
 *  @$everyPageNum:     每页展示条数
 */
function page_slip($curPage, $totalNum, $showPage, $everyPageNum) {
    $html = '';
    $totalPage = ceil($totalNum / $everyPageNum);                       // 总页数

    /* 当前页数格式化 */
    if($curPage <= 1 || $curPage == '') {
        $curPage = 1;
    } else if ($curPage >= $totalPage) {
        $curPage = $totalPage;
    }
    $html .= '<li><a href="/index.php/pageturn/0">' . '首页' . '</a></li>';
    $prePage = ($curPage <= 1) ? 1 : $curPage - 1;                              // 前一页
    $nextPage = ($curPage >= $totalPage) ? $totalPage : $curPage + 1;           // 后一页
    $html .= '<li class="arrow"><a href="/index.php/pageturn/' . $prePage . '">&laquo;</a></li>';                  // 前一页展示
    /* 展示显示分页 */
    $pageShowStart = (ceil($curPage / $showPage) - 1) * $showPage;
    //$pageShowEnd = ($pageShowStart + $showPage) > $totalPage ? $totalPage - ($pageShowStart + $showPage - $totalPage) - 1: $showPage;
    $pageShowEnd = ($pageShowStart + $showPage) > $totalPage ? $totalPage * 2 - $pageShowStart - $showPage - 1: $showPage;
    if ($showPage > $totalPage) {
        $showPage = $totalPage;
    } else if ($showPage > $pageShowEnd) {
        $showPage = $pageShowEnd;
    }

    /* 开始准备输出页数 */
    for($i = 1; $i <= $showPage; $i++) {
        $pageNow = $pageShowStart + $i;
        if($curPage == $pageNow) {
            $html .= '<li class="current"><a href="/index.php/pageturn/' . $pageNow . '">' . $pageNow . '</a></li>';
        } else {
            $html .= '<li><a href="/index.php/pageturn/' . $pageNow . '">' . $pageNow . '</a></li>';
        }
    }
    $html .= '<li><a href="/index.php/pageturn/' . $nextPage . '"> &raquo; </a></li>';                               // 后一页展示
    $html .= '<li><a href="/index.php/pageturn/' . $totalPage . '">' . '末页' . '</a></li>';                         // 末页展示
    $html .= '<br/><li><a>第' . $curPage . '/' . $totalPage . '页  ' . '</a></li>';
    $html .= '<li><a>共' . $totalNum . '篇文章</a></li>';              // 文章统计
    return $html;
}


function update_click_num() {
    $clk = new Click();
    $key = date('Ymd',time());
    $sql1 = 'INSERT INTO ltzydmh_click (idtime, num) VALUES (' . $key . ',1) ';
    $sql2 = 'UPDATE ltzydmh_click SET num=num+1 WHERE idtime=' . $key;
    try {
        $clk->execute($sql1);
    } catch(Exception $e) {
        try {
            $clk->execute($sql2);
        }catch (Exception $e) {
        }
    }
}

function server_ip() {
    $host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ?
        $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');

    return $host;
}

function url_type () {
    $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
    || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';

    return $http_type;
}

function trans_date($str) {
    $arr = str_split($str, 4);
    $year = $arr[0];
    $tmp = str_split($arr[1], 2);
    $month = $tmp[0];
    $day = $tmp[1];

    return "" . $year . '-' . $month . '-' . $day;
}

function index_passage_html($result) {
    $outBuf = "";
    foreach ($result as $i) {
        $djid = $i['djid'];
        $name = $i['name'];
        $summary = $i['summary'];
        $create_time = '创建 :' . trans_date($i['create_time']);
        $update_time = '更新 :' . trans_date($i['update_time']);
        $status = $i['status'];
        $category = $i['category'];
        $view = '阅读: ' . $i['viewcount'];

        $outBuf = $outBuf .
            '<article>'.
                '<div class="th padding_line">'.
                    '<h3><a id="passage_title" href="/index.php/passage/' . $djid . '">' . $name . '</a></h3>'.
                    '<span id="passage_category" class="space label info">' . $category . '</span>'.
                    '<span id="passage_status" class="space label alert">' . $status . '</span>'.
                    '<span id="passage_view" class="space label warning">' . $view . '</span>'.
                    '<span id="passage_create_time"class="space label">' . $create_time . '</span>'.
                    '<span id="passage_update_time" class="space label success">' . $update_time . '</span>'.
                    '<blockquote id="passage_summary">' . $summary . '</blockquote>'.
                '</div>'.
            '</article>'.
            '<br/>';
    }

    return $outBuf;
}