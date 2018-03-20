<?php

use app\index\model\Click;

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
                    '<h3><a id="passage_title" href="' . '/index.php/passage/' . $djid . '">' . $name . '</a></h3>'.
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