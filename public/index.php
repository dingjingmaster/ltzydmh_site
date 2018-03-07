<?php
define('APP_PATH', __DIR__ . '/../application/');
require __DIR__ . '/../thinkphp/start.php';
?>

<!DOCTYPE html>
<html xml:lang="zh-Hans" lang="zh-Hans">
<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>聆听朝阳的美好</title>
  <!-- CSS 文件 -->
  <link rel="stylesheet" href="assets/css/foundation.css">
</head>

<body id="blog">

<!-- 导航栏开始 -->
<nav class="top-bar" data-topbar>
  <ul class="title-area">
    <li class="name">
      <h1><a href="#">WebSiteName</a></h1>
    </li>
    <!-- 小屏幕上折叠按钮: 去掉 .menu-icon 类，可以去除图标。
      如果需要只显示图片，可以删除 "Menu" 文本 -->
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>

  <section class="top-bar-section">
    <ul class="left">
      <li class="active"><a href="#">Home</a></li>
      <li class="has-dropdown">
        <a href="#">Dropdown</a>
        <ul class="dropdown">
          <li><a href="#">Apple</a></li>
          <li><a href="#">Banana</a></li>
          <li><a href="#">Orange</a></li>
          <li class="divider"></li>
          <li><a href="#">Kale</a></li>
          <li><a href="#">Spinach</a></li>
        </ul>
      </li>
    </ul>
  </section>
</nav>
<br/>
<!-- 导航栏结束 -->

<!-- banner start -->

<!-- javascript -->
<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="assets/js/foundation.min.js"></script>
<script src="assets/js/vendor/modernizr.js"></script>
<script>
$(document).ready(function() {
    $(document).foundation();
})
</script>
</body>
</html>