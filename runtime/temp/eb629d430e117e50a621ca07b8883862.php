<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"G:\OneDrive\www\ltzydmh_site/application/index\view\index\index.html";i:1521109124;}*/ ?>
<!DOCTYPE html>
<html xml:lang="zh-Hans" lang="zh-Hans">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
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
        <!-- 主体内容 -->
        <div class="medium-9 large-9 columns">
            <?php echo $content; ?>
            
            <!-- 分页功能 -->
            <div class="pagination-centered">
                <ul class="pagination">

                    <!--
                    <li class="arrow"><a href="#">&laquo;</a></li>
                    <li class="current"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li class="arrow"><a href="#">&raquo;</a></li>
                    -->
                </ul>
            </div>
            <br><br>
        </div>
        <br/><br/>
        <!-- 主体内容完结 -->

        <!-- 侧边栏 -->
        <div class="medium-3 large-3 columns">
            <!-- 搜索框 -->
            <div class="row">
                <div class="small-8 medium-8 large-8 columns" style="padding-right: 0;">
                    <input type="text" class="th" placeholder="搜索"/>
                </div>
                <div class="small-4 medium-4 large-4 columns" style="padding: 0;">
                    <button type="button" class="button tiny" style=" margin-left: 12px;">搜索</button>
                </div>
            </div>

            <!-- 站点信息 -->
            <div class="th padding_line">
                <h5 class="subheader">站点信息</h5>
                <div class="panel">
                    <a id="passage_total" class="subheader">文章总数: <?php echo $passage; ?></a><br/>
                    <a id="category_total" class="subheader">分类总数: <?php echo $category; ?></a><br/>
                    <a id="comment_total" class="subheader">评论总数: <?php echo $comment; ?></a><br/>
                    <a id="visitor_total" class="subheader">访问总数: <?php echo $visitor; ?></a><br/>
                </div>
            </div>
            <br/><br/>

            <!-- 友情链接 -->
            <div class="th padding_line">
                <h5 class="subheader">友情链接</h5>
                <div class="panel">
                    <ul class="no-bullet">
                        <li><a href="#">链接1</a></li>
                        <li><a href="#">链接2</a></li>
                        <li><a href="#">链接3</a></li>
                        <li><a href="#">链接4</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- 侧边栏结束 -->
    </div>
    <!-- 主要内容 + 侧边栏 结束 -->
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