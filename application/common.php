<?php

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
        $create_time = '创建:' . trans_date($i['create_time']);
        $update_time = '更新:' . trans_date($i['update_time']);
        $status = $i['status'];
        $category = $i['category'];
        $view = $i['view'];

        $outBuf = $outBuf .
            '<article>'.
                '<div class="th padding_line">'.
                    '<h3><a id="passage_title" href="">' . $name . '</a></h3>'.
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