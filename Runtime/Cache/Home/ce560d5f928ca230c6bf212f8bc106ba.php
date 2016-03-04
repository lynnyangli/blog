<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
  <head>                  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ($DATA["title"]); ?></title>
    <link href="<?php echo ($PUBLIC_PATH); ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ($PUBLIC_PATH); ?>/css/show_article.css" rel="stylesheet">
	<script src="/Admin/public/ueditor1/ueditor.parse.js"></script>
 	<script type="text/javascript">
 		uParse("#content-main",{
 			rootPath:"/Admin/public/ueditor1/"
 		});
	</script>
  </head>
  <body> 
      <nav class="navbar navbar-inverse navbar-fixed-top">       
            <div class="container">
            <div class="navbar-header">
                    <a class="navbar-brand" href="#"><img src=""></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li ><a href="/index.php/Home/">首页</a></li>
                                    <?php if(is_array($CLASS)): foreach($CLASS as $k=>$vo): if($vo == $DATA.title): ?><li><a class="active" href="/index.php/Home/ChangeClass/index/class/<?php echo ($vo); ?>"><?php echo ($vo); ?></a></li>
					<?php else: ?>
						<li><a href="/index.php/Home/ChangeClass/index/class/<?php echo ($vo); ?>"><?php echo ($vo); ?></a></li><?php endif; endforeach; endif; ?>
                    </ul>              
            </div>
            </div>
      </nav>
      <div class="container">
          <div class="row">
              <div  id="main-content-left" class="col-md-3 ">
                  <div class="master-info">
                        <img class="master-img"src="<?php echo ($PUBLIC_PATH); ?>/img/head_log.jpg">
                        <p class="text-center master-name"><a href="#">l不要y</a></p>
                        <p class="text-center master-email"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>:1083709608@qq.com</p>
                        <p class="text-center master-email"><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>:<a href="">github.com/liyang</a></p>
                        <div>
                              <h3 class="master-sum">333<br><small>文章数</small></h3>
                              <h3 class="master-read">444<br><small>阅读量</small></h3>
                        </div>

                        <div class="max-list">
                          <ul class="list-unstyled ">
                              <?php if(is_array($READ_RANK)): foreach($READ_RANK as $key=>$vo): ?><li class="max-list-col"><span class="max-list-ico"></span><a class="max-list-a" href="/index.php/Home/ShowArticle/index/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></a>&nbsp;&nbsp;&nbsp;<span class="badge"><?php echo ($vo["read_sum"]); ?></span></li><?php endforeach; endif; ?>
                        </ul>
                      </div>

                      <div class="friend-link">
                          <ul class="list-unstyled">
                                <?php if(is_array($LINK_DATA)): foreach($LINK_DATA as $key=>$vo): ?><li><span class="glyphicon glyphicon-link" aria-hidden="true">&nbsp;<a href="<?php echo ($vo["link"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; ?>
                          </ul>
                  </div>
                  </div>
              </div>

              <div id="main-content-right" class="col-md-9">
                  <div class="content">
                      <div class="content-body">
                              <p class="text-center content-title"><a href="/index.php/Home/ShowArticle/index/id/<?php echo ($DATA["id"]); ?>"><?php echo ($DATA["title"]); ?></a></p>
                              <div class="content-other">
                                          <ul class="list-inline">
                                                <li><h4><span class="glyphicon glyphicon-time" aria-hidden="true">时间：<?php echo ($DATA["time"]); ?></span></h4></li>
                                                <li><h4><span class="glyphicon glyphicon-tag" aria-hidden="true">分类：<?php echo ($DATA["class"]); ?></span></h4></li>
                                          </ul>
                              </div>
                              <div id="content-main">
					<?php echo ($DATA["content"]); ?>
				</div>
                      </div>
                      <div class="content-foot">
                              <ul class="list-inline">
                                       <li><span class="glyphicon glyphicon-comment" aria-hidden="true">：<span class="label label-info" >*</span></span></li>
                                      <li><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true">：<span class="label label-warning">*</span></span></li>
                                       <li><span class="glyphicon glyphicon-search" aria-hidden="true">：<span class="label label-success"><?php echo ($DATA["read_sum"]); ?></span></span></li>
                               </ul>
                      </div>
                    </div>
              </div>
          </div>
      </div>
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo ($PUBLIC_PATH); ?>/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>