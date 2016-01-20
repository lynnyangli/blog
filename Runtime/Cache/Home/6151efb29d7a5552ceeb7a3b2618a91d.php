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
               
		#content-main{
			margin-top:1em;
		}
                #title{
                    margin-left: 1em;
                }
                .doment{
                    margin-bottom:1.2em;
                    position:relative;
                    background-color:#FFF;
                    border-radius: 6px;
                    padding: 6px;
                    border: solid 3px black ;
                }
		.domemt-body{
			/*border-left: solid 3px black ;*/  
			min-height: 100px;
                        font-size: 1.1em;
                        padding-bottom: 2em;
		}
		.doment-bottom{
			width:200px; height: 20px;
                        float: right;
                        position:  absolute;
                        bottom: 5px; right: 5px;
		}
                #head_img{
                    height: 150px;
                }
                 #title-right{
                    margin-top: 0px;
                    background-color: #FFF;
                    border:2px solid black;
                    border-radius: 6px;
                    margin-left:5em;
                    width:18em;
                }
                .list-left-tit{
                    border:2px solid black;
                    border-radius: 6px;
                    line-height: 1.3em;
                }
                .list-left{
                    /*border-right: solid 3px black;*/
                    /*border-left:solid 3px black;*/ 
                    margin-right:8px;  
                }
		 #get_more{
                        position:fixed;
                        bottom:1em;
                        left:45%;
                }
                #loading_img{
                        width:50px;
                        height:50px;
                        border-radius:40px;
                        display:none;
                }
               
	</style>
        <script type="text/javascript">
            var page = 2;
            function getMore()
            {
		var xhr;
                var class_type='<?php echo ($CLASS); ?>';
		var get_more = document.getElementById("get_more_bu");
		get_more.style.display="none";
		var lod_img = document.getElementById("loading_img");
		lod_img.style.display = "block";
		
		if(window.XMLHttpRequest){
			xhr=new XMLHttpRequest();
		}else{
			xhr=new ActiveXObjiect("Microsoft.XMLHTTP");	//IE5,6
		}
		xhr.onreadystatechange=function(){
			if(xhr.readyState==4)
			{
                            var mian_content = document.getElementById("main_content");
			    if(xhr.responseText==""){
			    	get_more.vaule = ""; 
			    }
                            main_content.innerHTML = main_content.innerHTML+xhr.responseText;
			}
			get_more.style.display="block";
			lod_img.style.display="none";
		}
		xhr.open("get","/index.php/Home/ChangeClass/getMore/class/"+class_type+"/page/"+page,true);7
		xhr.send(null);
                page++;
            }
	</script>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header ">
                                <!--<a href="" class="navbar-brand">Nobody's Blog</a>-->
				<!--<a href="#" class="navbar-brand" ><img id="head_img" src="/blog/Home/public/img/head.png" alt="Brand"></a>-->
                                
                        </div>
			<div class="collapse navbar-collapse " >
				<ul class="nav navbar-nav">
                                    <li> <a href="/index.php">首页</a></li>
                                    <?php if(is_array($CLASS_LIST)): foreach($CLASS_LIST as $k=>$vo): if($CLASS == $vo): ?><li class="active"><a  href="/index.php/Home/ChangeClass/index/class/<?php echo ($vo); ?>"><?php echo ($vo); ?></a></li>
                                           <?php else: ?> <li><a href="/index.php/Home/ChangeClass/index/class/<?php echo ($vo); ?>"><?php echo ($vo); ?></a></li><?php endif; endforeach; endif; ?>
				</ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="#">Email:1083709608@qq.com</a></li>
                                </ul>
			</div>
		</div>
	</nav>
    <div class="container">
            <h1 id="title"><?php echo ($CLASS_TITLE); ?></small></h1>
    </div>
	<div class="container-full" id="content-main">
            <div class="row">
            <div class="col-md-8 col-md-offset-1" id="main_content">
                <?php if(is_array($ARTICLES)): foreach($ARTICLES as $key=>$vo): ?><div class="doment" >
                    <div class="doment-head">
                        <a href="/index.php/Home/ShowArticle/index/id/<?php echo ($vo["id"]); ?>"><h3><?php echo ($vo["title"]); ?><small>&emsp;<?php echo ($vo["time"]); ?></small></h3></a>
                    </div>
                    <div class="domemt-body">
                        <p>&emsp;&emsp;<?php echo ($vo["description"]); ?></p>
                        <div class="doment-bottom">
                            <span class="glyphicon glyphicon-search" aria-hidden="true">阅读:<?php echo ($vo["read_sum"]); ?></span>&emsp;
                            <span class="gglyphicon glyphicon-pencil" aria-hidden="true">评论:<?php echo ($vo["comment_sum"]); ?></span>&emsp;
                        </div>
                     </div>
                </div><?php endforeach; endif; ?>
            </div>
            <div class="col-sm-3" id="title-right">
                <br/>
                <h4 class="list-left-tit">阅读排行</h4>
                    <ul class="list-group list-left">
                        <?php if(is_array($READ_RANK)): foreach($READ_RANK as $key=>$vo): ?><a href="/index.php/Home/ShowArticle/index/from/index/id/<?php echo ($vo["id"]); ?>" class="list-group-item  "><?php echo ($vo["title"]); ?><span class="badge"><?php echo ($vo["read_sum"]); ?></span></a><?php endforeach; endif; ?>
                    </ul>
                    <h4 class="list-left-tit">友情链接</h4>
                    <ul class="list-group list-left">
                        <?php if(is_array($LINK_DATA)): foreach($LINK_DATA as $key=>$vo): ?><a href="<?php echo ($vo["link"]); ?>" class="list-group-item" target="_blank"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; ?>
                    </ul>
            </div>
            </div>     
	</div>
    <div  id="get_more">
           <h4 id='get_more_bu'> <a onclick="getMore(this);return false;" href="#"><span class="label label-default">加载更多</span></a></h4>
   	<img id="loading_img"  src="<?php echo ($PUBLIC_PATH); ?>/img/loading.gif" />
    </div>
        
</body>
</html>