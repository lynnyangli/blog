<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE  html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/Home/public/bootstrap/css/bootstrap.min.css">
	<style type="text/css">
		body{
                    background: url(/Home/public/img/bg_1.jpg) no-repeat center 0; background-size:100% 100%; background-attachment:fixed;
			height: 100%;
			margin-top: 50px;
                        background-color: #ccc;
		}
                .path_addr{
                    position:relative;
                    left:-3em;
                }
                .head_article{
                    margin-top: 1em;
                    border-radius: 6px;
                     padding-left: 3em;
                }
                 #title-right{
                    margin-top: 130px;
                    background-color: #FFF;
                    border:2px solid black;
                    border-radius: 6px;
                    margin-left:5em;
                    width:18em;
                }
                .list-left-tit{
                    border:2px solid black;
                    border-radius: 6px;
                    font-size: 1.5em;
                    line-height:1.3em;
                }
                .list-left{
                    border-right: solid 3px black;
                    border-left:solid 3px black; 
                    margin-right:8px; 
                }
                #content{
                    background-color: #FFF;
                    border:2px solid black;
                    border-radius: 6px;
                    padding: 10px;
                }
               
	</style>
        <script src="/blog/Home/public/ueditor1/ueditor.parse.js"></script>
 	<script type="text/javascript">
 		uParse("#content",{
 			rootPath:"/blog/Admin/public/ueditor1/"
 		});
 	</script>
        
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="collapse navbar-collapse " >
				<ul class="nav navbar-nav">
                                    <li><a href="/index.php/">首页</a></li>
                                    <?php if(is_array($CLASS)): foreach($CLASS as $k=>$vo): ?><li><a href="/index.php/Home/ChangeClass/index/class/<?php echo ($vo); ?>"><?php echo ($vo); ?></a></li><?php endforeach; endif; ?>
				</ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="#">Email:1083709608@qq.com</a></li>
                                </ul>
			</div>
		</div>
	</nav>
	<div class="container-full" id="content-main">
            <div class="row">
            <div class="col-md-8 col-md-offset-1" id="main_content">
                <div class="head_article">
                    <ol class="breadcrumb path_addr">
                        <li><a href="/index.php/Home/ChangeClass/index/class/<?php echo ($DATA["class"]); ?>"><?php echo ($DATA["class"]); ?></a></li>
                        <li><a href="#"><?php echo ($DATA["title"]); ?></a></li>
                     </ol>
                    <h1 style="margin-top:2px;"><?php echo ($DATA["title"]); ?>
                            <small><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span><?php echo ($DATA["class"]); ?></small>
                            <small><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><?php echo ($DATA["time"]); ?></small>
                            
                    </h1>
                    
                    
                </div>
                <div id="content">
                    <?php echo ($DATA["content"]); ?>
                </div>
            </div>
            <div class="col-sm-2" id="title-right">
                <br/>
                <h4 class="list-left-tit">阅读排行</h4>
                    <ul class="list-group list-left">
                        <?php if(is_array($READ_RANK)): foreach($READ_RANK as $key=>$vo): ?><a href="/index.php/Home/ShowArticle/index/from/index/id/<?php echo ($vo["id"]); ?>" class="list-group-item  "><?php echo ($vo["title"]); ?><span class="badge"><?php echo ($vo["read_sum"]); ?></span></a><?php endforeach; endif; ?>
                    </ul>
                    <h4 class="list-left-tit">友情链接</h4>
                    <ul class="list-group list-left">
                        <?php if(is_array($LINK_DATA)): foreach($LINK_DATA as $key=>$vo): ?><a href="<?php echo ($vo["link"]); ?>" class="list-group-item"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; ?>
                    </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="#">Email:1083709608@qq.com</a></li>
                                </ul>
            </div>
            </div>     
	</div>
    <div class="foot row">
        
    </div>
    <div id="ajax">
        
    </div>
</body>
</html>