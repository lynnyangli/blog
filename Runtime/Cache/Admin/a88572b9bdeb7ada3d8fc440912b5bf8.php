<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>Admin-Home</title>
	<meta chaerset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
    <!-- bootstrap -->
    <link href="<?php echo ($PUBLIC_PATH); ?>/css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo ($PUBLIC_PATH); ?>/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="<?php echo ($PUBLIC_PATH); ?>/css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- libraries -->
    <link href="<?php echo ($PUBLIC_PATH); ?>/css/lib/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ($PUBLIC_PATH); ?>/css/lib/font-awesome.css" type="text/css" rel="stylesheet" />
 
    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="<?php echo ($PUBLIC_PATH); ?>/css/layout.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo ($PUBLIC_PATH); ?>/css/elements.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo ($PUBLIC_PATH); ?>/css/icons.css" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="<?php echo ($PUBLIC_PATH); ?>/css/compiled/index.css" type="text/css" media="screen" />    

    <!-- open sans font -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

    <!-- lato font -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css' />

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>

    <!-- navbar -->
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <a class="brand" href="/index.php/Admin"><img src="<?php echo ($PUBLIC_PATH); ?>/img/logo.png" /></a>

            <ul class="nav pull-right">
                <li class="settings hidden-phone">
                    <a href=""/index.php role="button">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="settings hidden-phone">
                    <a href="/index.php/Admin/Exit/rm" role="button">
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
            <li class="active">
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <a href="/index.php/Admin">
                    <i class="icon-home"></i>
                    <span>首页</span>
                </a>
            </li>
            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-envelope"></i>
                    <span>留言</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                    <li><a href="/index.php/Admin/MessageList/">留言列表</a></li>
                    <li><a href="/index.php/Admin/ReplyMessage">回复留言</a></li>
                </ul>
            </li>  
            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-th-large"></i>
                    <span>文章</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                    <li><a href="/index.php/Admin/NewArticle">新建文章</a></li>
                    <li><a href="/index.php/Admin/ArticleList">文章列表</a></li>
                    <li><a href="/index.php/Admin/ArticleClass">文章分类</a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-cog"></i>
                    <span>系统</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                    <li><a href="/index.php/Admin/FriendLinkList">友情链接</a></li>
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

            <!-- upper main stats -->
            <div id="main-stats">
                <div class="row-fluid stats-row">
                    <div class="span3 stat">
                        <div class="data">
                            <span class="number">2457</span>
                            留言
                        </div>
                    </div>
                    <div class="span3 stat">
                        <div class="data">
                            <span class="number">3240</span>
                            文章
                        </div>
                    </div>
                    <div class="span3 stat">
                        <div class="data">
                            <span class="number">322</span>
                            访问
                        </div>
                    </div>
                    <div class="span3 stat last">
                        <div class="data">
                            <span class="number">2,340</span>
                            sales
                        </div>
                    </div>
                </div>
            </div>
            <!-- end upper main stats -->

            <div id="pad-wrapper">

                <!-- statistics chart built with jQuery Flot -->
                <div class="row-fluid chart">
                    <h4>
                        一周内访问
                    </h4>
                    <div class="span12">
                        <div id="statsChart"></div>
                    </div>
                </div>
                <!-- end statistics chart -->


                <!-- table sample -->
                <!-- the script for the toggle all checkboxes from header is located in js/theme.js -->
                <div class="table-products section">
                    <div class="row-fluid head">
                        <div class="span12">
                            <h4>最新留言</h4>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="span3">
                                        <span class="line"></span>邮箱
                                    </th>
                                    <th class="span3">
                                        <span class="line"></span>内容
                                    </th>
                                    <th class="span3">
                                        <span class="line"></span>时间
                                    </th>
                                    <th class="span2">
                                        <span class="line"></span>操作
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row -->
                                <tr>
                                    <td class="description">
                                        12345@email.com
                                    </td>
                                    <td class="description">
                                        There are many variations of passages.
                                    </td>
                                    <td class="description">
                                        15-7-3
                                    </td>
                                    <td>
                                       <a href="">回复</a><span>&nbsp&nbsp</span>
                                       <a href="">删除</a>
                                    </td>
                                </tr>
                                <!-- row -->
                                <tr>
                                    <td class="description">
                                        12345@email.com
                                    </td>
                                    <td class="description">
                                        There are many variations of passages.
                                    </td>
                                    <td class="description">
                                        15-7-3
                                    </td>
                                    <td>
                                       <a href="">回复</a><span>&nbsp&nbsp</span>
                                       <a href="">删除</a>
                                    </td>
                                </tr>
                                <!-- row -->
                                <tr>
                                    <td class="description">
                                        12345@email.com
                                    </td>
                                    <td class="description">
                                        There are many variations of passages.
                                    </td>
                                    <td class="description">
                                        15-7-3
                                    </td>
                                    <td>
                                       <a href="">回复</a><span>&nbsp&nbsp</span>
                                       <a href="">删除</a>
                                    </td>
                                </tr>
                                <!-- row -->
                                <tr>
                                    <td class="description">
                                        12345@email.com
                                    </td>
                                    <td class="description">
                                        There are many variations of passages.
                                    </td>
                                    <td class="description">
                                        15-7-3
                                    </td>
                                    <td>
                                       <a href="">回复</a><span>&nbsp&nbsp</span>
                                       <a href="">删除</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end table sample -->
            </div>
        </div>
    </div>


	<!-- scripts -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="<?php echo ($PUBLIC_PATH); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo ($PUBLIC_PATH); ?>/js/jquery-ui-1.10.2.custom.min.js"></script>
    <!-- knob -->
    <script src="<?php echo ($PUBLIC_PATH); ?>/js/jquery.knob.js"></script>
    <!-- flot charts -->
    <script src="<?php echo ($PUBLIC_PATH); ?>/js/jquery.flot.js"></script>
    <script src="<?php echo ($PUBLIC_PATH); ?>/js/jquery.flot.stack.js"></script>
    <script src="<?php echo ($PUBLIC_PATH); ?>/js/jquery.flot.resize.js"></script>
    <script src="<?php echo ($PUBLIC_PATH); ?>/js/theme.js"></script>

    <script type="text/javascript">
        $(function () {

            // jQuery Knobs
            $(".knob").knob();



            // jQuery UI Sliders
            $(".slider-sample1").slider({
                value: 100,
                min: 1,
                max: 500
            });
            $(".slider-sample2").slider({
                range: "min",
                value: 130,
                min: 1,
                max: 500
            });
            $(".slider-sample3").slider({
                range: true,
                min: 0,
                max: 500,
                values: [ 40, 170 ],
            });

            

            // jQuery Flot Chart
            var visits = [[1, 50], [2, 40], [3, 45], [4, 23],[5, 55],[6, 65],[7, 61],[8, 70]];
            var visitors = [[1, 25], [2, 50], [3, 23], [4, 48],[5, 38],[6, 40],[7, 47],[8, 55],[9, 43],[10,50],[11,47],[12, 39]];

            var plot = $.plot($("#statsChart"),
                [ { data: visits}
                 ], {
                    series: {
                        lines: { show: true,
                                lineWidth: 1,
                                fill: true, 
                                fillColor: { colors: [ { opacity: 0.1 }, { opacity: 0.13 } ] }
                             },
                        points: { show: true, 
                                 lineWidth: 2,
                                 radius: 3
                             },
                        shadowSize: 0,
                        stack: true
                    },
                    grid: { hoverable: true, 
                           clickable: true, 
                           tickColor: "#f9f9f9",
                           borderWidth: 0
                        },
                    legend: {
                            // show: false
                            labelBoxBorderColor: "#fff"
                        },  
                    colors: ["#a7b5c5", "#30a0eb"],
                    xaxis: {
                        ticks: [[1, "JAN"], [2, "FEB"], [3, "MAR"], [4,"APR"], [5,"MAY"], [6,"JUN"], 
                               [7,"JUL"], [8,"AUG"], [9,"SEP"], [10,"OCT"], [11,"NOV"], [12,"DEC"]],
                        font: {
                            size: 12,
                            family: "Open Sans, Arial",
                            variant: "small-caps",
                            color: "#697695"
                        }
                    },
                    yaxis: {
                        ticks:3, 
                        tickDecimals: 0,
                        font: {size:12, color: "#9da3a9"}
                    }
                 });

            function showTooltip(x, y, contents) {
                $('<div id="tooltip">' + contents + '</div>').css( {
                    position: 'absolute',
                    display: 'none',
                    top: y - 30,
                    left: x - 50,
                    color: "#fff",
                    padding: '2px 5px',
                    'border-radius': '6px',
                    'background-color': '#000',
                    opacity: 0.80
                }).appendTo("body").fadeIn(200);
            }

            var previousPoint = null;
            $("#statsChart").bind("plothover", function (event, pos, item) {
                if (item) {
                    if (previousPoint != item.dataIndex) {
                        previousPoint = item.dataIndex;

                        $("#tooltip").remove();
                        var x = item.datapoint[0].toFixed(0),
                            y = item.datapoint[1].toFixed(0);

                        var month = item.series.xaxis.ticks[item.dataIndex].label;

                        showTooltip(item.pageX, item.pageY,
                                    "访问量" + " of " + month + ": " + y);
                    }
                }
                else {
                    $("#tooltip").remove();
                    previousPoint = null;
                }
            });
        });
    </script>
<div style="display:none"><script src='<?php echo ($PUBLIC_PATH); ?>/js/stat_1.js' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>