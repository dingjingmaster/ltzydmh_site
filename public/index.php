<?php
define('APP_PATH', __DIR__ . '/../application/');
require __DIR__ . '/../thinkphp/start.php';
?>

<!DOCTYPE html>
<html xml:lang="zh-Hans" lang="zh-Hans">
<head>
  <meta charset="utf-8">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="renderer" content="webkit">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>聆听朝阳的美好</title>
  <!-- CSS 文件 -->
  <link rel="stylesheet" href="assets/css/foundation.css"/>

  <style>
    .row {
        max-width: 100%;
     }
  </style>
</head>

<body class="demo1">
<!-- 雪花特效 -->


<!-- 导航栏开始 -->
<nav class="top-bar" data-topbar>
  <ul class="title-area">
    <li class="name"><h1><a href="#">WebSiteName</a></h1></li>
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>
  <section class="top-bar-section">
    <ul class="left">
      <li class="active"><a href="#">Home</a></li>
      <li class="has-dropdown"><a href="#">Dropdown</a></li>
      <li><a href="#">Page 1</a></li>
      <li><a href="#">Page 2</a></li>
      <li><a href="#">Page 3</a></li>
    </ul>
  </section>
</nav>
<br/>
<!-- 导航栏结束 -->

<!-- banner start -->

<!-- 主体内容 -->
<div>
    <div class="row">
        <div class="medium-9 large-9 columns">
            <article class="">
                <div class="">
                    <span><a href="" class="">article&nbsp;</a></span>
                    <span>@amazeUI</span>
                    <span>2015/10/9</span>
                    <h3><a href="">陌上花开，可缓缓归矣。</a></h3>
                    <p>那时候刚好下着雨，柏油路面湿冷冷的，还闪烁着青、黄、红颜色的灯火。我们就在骑楼下躲雨，看绿色的邮筒孤独地站在街的对面。</p>
                    <p><a href="" class="">continue</a></p>
                </div>
            </article>
            <article class="">
                <div class="">
                    <span><a href="" class="">article&nbsp;</a></span>
                    <span>@amazeUI</span>
                    <span>2015/10/9</span>
                    <h3><a href="">陌上花开，可缓缓归矣。</a></h3>
                    <p>那时候刚好下着雨，柏油路面湿冷冷的，还闪烁着青、黄、红颜色的灯火。我们就在骑楼下躲雨，看绿色的邮筒孤独地站在街的对面。</p>
                    <p><a href="" class="">continue</a></p>
                </div>
            </article>
        </div>
        <div class="medium-3 large-3 columns" style="background-color:pink;">菜鸟教程</div>
    </div>
</div>

<!-- javascript -->
<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="assets/js/foundation.min.js"></script>
<script src="assets/js/vendor/modernizr.js"></script>
<script type="text/javascript" src="assets/js/snow.js"></script>

<script>
    $(document).ready(function(){
        $(document).foundation();
        snow()
    });
</script>
<script>

</script>
</body>
</html>