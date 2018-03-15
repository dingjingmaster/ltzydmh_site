<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"G:\OneDrive\www\ltzydmh_site/application/index\view\passage\read.html";i:1521121373;}*/ ?>
<!DOCTYPE html>
<html xml:lang="zh-Hans" lang="zh-Hans">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="<?php echo $keyword; ?>">
    <meta name="description" content="<?php echo $keyword; ?>">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo $host; ?>/public/assets/img/dj.icon" type="image/x-icon"/>
    <title>丁敬de个人博客</title>
    <!-- CSS 文件 -->
    <link rel="stylesheet" href="<?php echo $host; ?>/public/assets/css/foundation.css"/>
    <link rel="stylesheet" href="<?php echo $host; ?>/public/assets/css/main.css"/>
</head>
<body>
<!-- 导航栏开始 -->
<div class="sticky">
    <nav class="top-bar" data-topbar data-options="sticky_on:large">
        <ul class="title-area">
            <li class="name"><a href="<?php echo $host; ?>"><img src="<?php echo $host; ?>/public/assets/img/dj_blog.png"/></a></li>
            <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
        </ul>
        <!-- 导航栏按钮开始 -->
        <section class="top-bar-section">
            <ul class="left">
                <li><a href="<?php echo $host; ?>">首页</a></li>
                <li class="has-dropdown">
                    <a href="#">理论基础</a>
                    <ul class="dropdown">
                        <li><a href="#">Page 1</a></li>
                        <li><a href="#">Page 2</a></li>
                        <li><a href="#">Page 3</a></li>
                    </ul>
                </li>
                <li class="has-dropdown">
                    <a href="#">实战记录</a>
                    <ul class="dropdown">
                        <li><a href="#">Page 1</a></li>
                        <li><a href="#">Page 2</a></li>
                        <li><a href="#">Page 3</a></li>
                    </ul>
                </li>
                <li class="has-dropdown">
                    <a href="#">常见问题解决</a>
                    <ul class="dropdown">
                        <li><a href="#">Page 1</a></li>
                        <li><a href="#">Page 2</a></li>
                        <li><a href="#">Page 3</a></li>
                    </ul>
                </li>
                <li><a href="#">文章归档</a></li>
                <li><a href="#">关于作者</a></li>
            </ul>

        </section>
        <!-- 导航栏按钮结束 -->
    </nav>
</div>
<!-- 导航栏结束 -->
<br/>

<!-- banner start -->

<div>
    <hr/>
    <div class="row">
        <!-- 侧边栏 -->
        <div class="medium-3 large-3 columns"></div>
        <!-- 侧边栏结束 -->
        <br/><br/>

        <!-- 主体内容 -->
        <div class="medium-9 large-9 columns">
            <?php echo $content; ?>

            <br><br>
        </div>
        <!-- 主体内容完结 -->
    </div>
</div>
<!-- 正文部分结束 -->
<br/>

<!-- 页脚开始 -->
<footer class="footer">
    <ul class="small-block-grid-2 medium-block-grid-4 large-block-grid-4">
        <li>
            <h5 class="subheader panel">关于本站</h5>
            <small class="subheader panel">本站旨在总结个人所学,帮助自己梳理知识.欢迎志同道合的朋友交流留言,让我们在技术这条路上共勉！</small>
        </li>
        <li>
            <h5 class="subheader panel">关于作者</h5>
            <small class="subheader panel">作为一名新手,我的技术还远远不够好,工作中遇到问题只能自己寻求解决办法,这样工作很吃力,也浪费时间.
                因此,我希望通过此站能帮到像我一样的新手,同时得到一些技术大咖的帮助.</small>
        </li>
        <li>
            <h5 class="subheader panel">公众号</h5>
            <small class="subheader panel">暂时没有</small>
        </li>
        <li>
            <h5 class="subheader panel">版权声明</h5>
            <small class="subheader panel">暂时没有</small>
        </li>
    </ul>
</footer>
<br/><br/>
<!-- 页脚结束 -->
<!-- javascript -->
<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="<?php echo $host; ?>/public/assets/js/foundation.min.js"></script>
<script src="<?php echo $host; ?>/public/assets/js/vendor/modernizr.js"></script>
<script src="<?php echo $host; ?>/public/assets/js/snow.js"></script>
<script>
    $(document).ready(function(){
        $(document).foundation();
        snow()
    });
</script>
</body>
</html>