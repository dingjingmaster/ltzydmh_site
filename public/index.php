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
  <style>
    .row {
        max-width: 100%;
     }
  </style>
</head>

<body>
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
        <div class="medium-9 large-9 columns" style="background-color:yellow;">菜鸟教程</div>
        <div class="medium-3 large-3 columns" style="background-color:pink;">菜鸟教程</div>
    </div>
</div>


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