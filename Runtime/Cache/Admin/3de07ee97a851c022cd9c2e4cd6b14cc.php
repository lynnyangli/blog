<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>友情链接列表</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
    <!-- bootstrap -->
    <link href="<?php echo ($PUBLIC_PATH); ?>/css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo ($PUBLIC_PATH); ?>/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="<?php echo ($PUBLIC_PATH); ?>/css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="<?php echo ($PUBLIC_PATH); ?>/css/layout.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo ($PUBLIC_PATH); ?>/css/elements.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo ($PUBLIC_PATH); ?>/css/icons.css" />

    <!-- libraries -->
    <link href="<?php echo ($PUBLIC_PATH); ?>/css/lib/font-awesome.css" type="text/css" rel="stylesheet" />
    
    <!-- this page specific styles -->
    <link rel="stylesheet" href="<?php echo ($PUBLIC_PATH); ?>/css/compiled/tables.css" type="text/css" media="screen" />

    <!-- open sans font -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
    #add_class{
        width: 600px;
        padding-top: 12px; padding-left: 12px;
        display: none;
        border: #ccc solid 1px;
        border-radius: 4px;
    }
</style>
<script type="text/javascript">
    var add_class_state=0;
    function show_add_class()
    {
        var add_class=document.getElementById("add_class");
        if(add_class_state==0)
        {
            add_class_state=1;
            add_class.style.display="block";
        }else if(add_class_state==1){
            add_class_state=0;
            add_class.style.display="none";
        }
    }
</script>
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
            
            <a class="brand" href="/index.php/Admin"><img src="<?php echo ($PUBLIC_PATH); ?>/img/logo.png" /></a>

            <ul class="nav pull-right">   
                <li class="settings hidden-phone">
                    <a href="/index.php/Admin/" role="button">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="settings hidden-phone">
                    <a href="/index.php/Admin/Exit/" role="button">
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
            <li >
               
                <a class="dropdown-toggle" href="#">
                    <i class="icon-envelope"></i>
                    <span>留言</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                    <li ><a href="<?php echo ($APP_PATH); ?>/index.php/Admin/MessageList/"class="active">留言列表</a></li>
                    <li><a href="<?php echo ($APP_PATH); ?>/index.php/Admin/ReplyMessage">回复留言</a></li>
                </ul>
            </li>  
            <li >
                <a class="dropdown-toggle" href="#">
                    <i class="icon-th-large"></i>
                    <span>文章</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                    <li><a href="<?php echo ($APP_PATH); ?>/index.php/Admin/NewArticle">新建文章</a></li>
                    <li><a href="<?php echo ($APP_PATH); ?>/index.php/Admin/ArticleList">文章列表</a></li>
                    <li><a href="<?php echo ($APP_PATH); ?>/index.php/Admin/ArticleClass">文章分类</a></li>
                </ul>
            </li>
            <li class="active">
                 <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
		 </div>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-cog"></i>
                    <span>系统</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu active">
                    <li><a class="active" href="/index.php/Admin/FriendLinkList">友情链接</a></li>
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
        <?php echo ($tip); ?>
        <div class="container-fluid">
            <div id="pad-wrapper">
                
                <!-- products table-->
                <!-- the script for the toggle all checkboxes from header is located in js/theme.js -->
                <div class="table-wrapper products-table section">
                    <div class="row-fluid head">
                        <div class="span12">
                            <h4>友情链接列表</h4>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="span2">
                                        ID
                                    </th>
                                    <th class="span3">
                                        名称
                                    </th>
                                    <th class="span3">
                                        描述
                                    </th>
                                    <th class="span3">
                                       链接地址
                                    </th>
                                    <th class="span2">
                                     操作
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($LINK_DATA)): foreach($LINK_DATA as $k=>$vaule): ?><tr>
                                    <td>
                                        <?php echo ($vaule["id"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($vaule["name"]); ?>
                                    </td>
                                    <td class="description">
                                        <?php echo ($vaule["des"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($vaule["link"]); ?>
                                    </td>
                                    <td>
                                    <a href="/index.php/Admin/FriendLinkList/delelink/id/<?php echo ($vaule["id"]); ?>">删除</a>
                                    </td>
                                </tr><?php endforeach; endif; ?>
                            </tbody>
                        </table>
                         
                    </div>
                </div>
                <!-- end products table -->
                <a class="btn-flat success new-product" onclick="show_add_class(); return false;">+添加链接</a>
                <div id="add_class">
                    <form action="/index.php/Admin/FriendLinkList/addlink" method="post"/>
                            <div class="field-box">
                                <label>名称:</label>
                                <input class="span6 inline-input"  type="text" name="name"/>
                            </div> 
                            <div class="field-box">
                                <label>URL:</label>
                                <input class="span6 inline-input" type="text" name="link"/>
                            </div>
			    <div class="field-box">
                                <label>描述:</label>
                                <input class="span6 inline-input" type="text" name="des"/>
                            </div>   
                            <button type="submit" class="btn btn-primary">保存</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end main container -->

	<!-- scripts -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="<?php echo ($PUBLIC_PATH); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo ($PUBLIC_PATH); ?>/js/theme.js"></script>
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>