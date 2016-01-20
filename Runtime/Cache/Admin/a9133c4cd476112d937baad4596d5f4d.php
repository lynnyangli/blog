<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>Reply-Message</title>
    
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
    <!-- bootstrap -->
    <link href="<?php echo ($PUBLIC_PATH); ?>/css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo ($PUBLIC_PATH); ?>/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="<?php echo ($PUBLIC_PATH); ?>/css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="/webapp/Admin/public/css/layout.css" />
    <link rel="stylesheet" type="text/css" href="/webapp/Admin/public/css/elements.css" />
    <link rel="stylesheet" type="text/css" href="/webapp/Admin/public/css/icons.css" />

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="<?php echo ($PUBLIC_PATH); ?>/css/lib/font-awesome.css" />
    
    <!-- this page specific styles -->
    <link rel="stylesheet" href="<?php echo ($PUBLIC_PATH); ?>/css/compiled/new-user.css" type="text/css" media="screen" />

    <!-- open sans font -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



</head>
<body>

    <!-- navbar -->
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <button type="button" class="btn btn-navbar visible-phone" id="menu-toggler">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            <a class="brand" href="index.html"><img src="img/logo.png" /></a>

            <ul class="nav pull-right"> 
                <li class="settings hidden-phone">
                    <a href="/webapp/index.php" role="button">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="settings hidden-phone">
                    <a href="/webapp/index.php/Admin/Exit/" role="button">
                        <i class="icon-share-alt"></i>
                    </a>
                </li>
            </ul>            
        </div>
    </div>
    <!-- end navbar -->

    <!-- sidebar -->
    <div id="sidebar-nav">
        <ul id="dashboard-menu">
            <li >
                <a href="<?php echo ($APP_PATH); ?>/index.php/Admin">
                    <i class="icon-home"></i>
                    <span>首页</span>
                </a>
            </li>
            <li class="active">
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-envelope"></i>
                    <span>留言</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu active">
                    <li ><a href="<?php echo ($APP_PATH); ?>/index.php/Admin/MessageList/">留言列表</a></li>
                    <li><a href="<?php echo ($APP_PATH); ?>/index.php/Admin/ReplyMessage" class="active">回复留言</a></li>
                </ul>
            </li>  
            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-th-large"></i>
                    <span>文章</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                    <li><a href="<?php echo ($APP_PATH); ?>/index.php/Admin/NewArticle" class="active">新建文章</a></li>
                    <li><a href="<?php echo ($APP_PATH); ?>/index.php/Admin/ArticleList">文章列表</a></li>
                    <li><a href="<?php echo ($APP_PATH); ?>/index.php/Admin/ArticleClass">文章分类</a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-cog"></i>
                    <span>系统</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                    <li><a href="/webapp/index.php/Admin/CreateNewProduct">首页</a></li>
                    <li><a href="/webapp/index.php/Admin/ProductList">我的</a></li>
                    <li><a href="/webapp/index.php/Admin/HomeProducts">其它</a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-share-alt"></i>
                    <span>退出</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                    <li><a href="/webapp/index.php/Admin/Exit/">安全退出</a></li>
                    <li><a href="/webapp/index.php/Admin/Exit/index/state/and">重新登录</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- end sidebar -->


	<!-- main container -->
    <div class="content">
        
        <div class="container-fluid">
            <div id="pad-wrapper" class="new-user">
                <div class="row-fluid header" >
                    <h3>回复留言</h3>
                </div>
                <div class="row-fluid form-wrapper">
                    <!-- left column -->
                    <div class="span9 with-sidebar">
                        <div class="container" id="content">
                            <form class="new_user_form inline-input" action="<?php echo ($APP_PATH); ?>/index.php/Admin/DoReplyMessage/" method="post"/>
                                <div class="span12 field-box">
                                    <label>邮箱:</label>
                                    <input class="span9" name="title" type="email" value="<?php echo ($email); ?>"/>
                                </div>
                                <div class="span12 field-box">
                                    <label>标题:</label>
                                    <input class="span9" name="title" type="title" />
                                </div>
                                <button type="button"class="btn btn-success btn-lg" onclick="return false">详细内容</button>
                               
                                <script id="container" name="content" type="text/plain">
                                    
                                </script>
                                <div class="span11 field-box actions" id="sub">
                                    <input type='submit' class="btn-glow primary" value="回复" />
                                    <span>OR</span>
                                    <input type="reset" value="清空" class="reset" />
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- side right column -->
                    <div class="span3 form-sidebar pull-right">
                        <div class="alert alert-info hidden-tablet">
                            <i class="icon-lightbulb pull-left"></i>
                            详细内容
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main container -->


	<!-- scripts -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="/webapp/Admin/public/js/bootstrap.min.js"></script>
    <script src="/webapp/Admin/public/js/theme.js"></script>
    
    <script type="text/javascript" src="<?php echo ($PUBLIC_PATH); ?>/ueditor1/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="<?php echo ($PUBLIC_PATH); ?>/ueditor1/ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container',{
            initialFrameWidth:750,
            initialFrameHeight:500,
        });
    </script>

    <script type="text/javascript">
        $(function () {

            // toggle form between inline and normal inputs
            var $buttons = $(".toggle-inputs button");
            var $form = $("form.new_user_form");

            $buttons.click(function () {
                var mode = $(this).data("input");
                $buttons.removeClass("active");
                $(this).addClass("active");

                if (mode === "inline") {
                    $form.addClass("inline-input");
                } else {
                    $form.removeClass("inline-input");
                }
            });
        });
    </script>
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>