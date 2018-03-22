<?php
header ( 'Content-Type: text/html; charset=utf-8' );
//分页
$page=$_GET['page'];
$allcount= 100;
$page_size =10;
$page_show =5;
echo '当前是第: ' . $page . '页';
$page_count = ceil($allcount/$page_size);
if($page <= 1 || $page == '') $page = 1;
if($page >= $page_count) $page = $page_count;
$pre_page = ($page == 1)? 1 : $page - 1;
$next_page= ($page == $page_count)? $page_count : $page + 1 ;
$pagenav .= "第 $page/$page_count 页 共 $allcount 条记录 ";
$pagenav .= "<a href='?page=1'>首页</a> ";
$pagenav .= "<a href='?page=$pre_page'>前一页</a> ";
//当前显示的开始
$page_show_start = (ceil($page/$page_show)-1)*$page_show;
//显示分页
$page_show_str = '';
if($page_show>$page_count){
  $page_show = $page_count;
}
for($j=1;$j<=$page_show;$j++){
  $page_show_now = $page_show_start+$j;
  if($page==$page_show_now){
    $page_show_str .= "<a href='?page=$page_show_now'><strong>$page_show_now</strong></a> ";
  }else{
    $page_show_str .= "<a href='?page=$page_show_now'>$page_show_now</a> ";
  }
}
$pagenav.=$page_show_str;
$pagenav .= "<a href='?page=$next_page'>后一页</a> ";
$pagenav .= "<a href='?page=$page_count'>末页</a>";
echo '<div class="page">'.$pagenav.'</div>' ;
?>