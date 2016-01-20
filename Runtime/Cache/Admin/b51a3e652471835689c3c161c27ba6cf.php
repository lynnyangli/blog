<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<script type="text/javascript">
		function show_item(link){
			var item;
			while(link.nextSibling.nodeType!=1)
			{	
				link=link.nextSibling;
			}
			item=link.nextSibling;
			if(item.style.display=="block"){
				item.style.display="none";
			}else{
				item.style.display="block";
			}
			return false;
		}
	</script>
	<style type="text/css">
		*{
			margin: 0px; padding:0px;
		}
		body{
			background: url(<?php echo ($m_public); ?>/img/7.jpg) no-repeat; background-size: 100% 100%;  background-attachment:fixed;
		}
		.header{
			height: 50px;
			color: white;  font-family: tahoma,"Microsoft Yahei"; font-size: 1.2em;
			background-color: rgba(23,23,23,.5);
		}
		.header_right{
			float: right;
		}
		.header_left{
			float: left;
			margin-left: 20px;
		}
		.header_img{
			height:43px; width: 43px;
			float: left; 
			border-radius: 43px;
			margin-top:4px;
		}
		.header_left span{
			display: block;
			float: left; margin-left: 5px;
			line-height: 50px; 
			font-size: 1.3em;
		}
		.header_right_user{
			display: block;
			float: left; margin-right:25px;
			line-height: 50px; 
			font-size: 1.2em;
		}
		.header_right_exit{
			font-size: 0.8em; line-height: 50px;
			margin-right: 30px;
		}
		.content_left{
			float: left;
			width: 200px; height:80%;
			background-color: rgba(111,94,100,.6);
			color: white;
		}
		.content_left_item{
			list-style: none;
		}
		.left_item_title{
			display: block; 
			text-decoration: none; text-align: center; line-height: 60px;
			font-size: 1.3em; color:white;
		}
		#left_item_con_1{
			display: none; list-style: none;
			text-align: center; text-decoration: none; 
			background-color: rgba(255,255,255,.2);
		}
		#left_item_con_1 li a{
			display: block;
			font-size: 1em;  line-height: 35px;
			border-bottom: #ccc solid 1px;
			text-decoration: none; color: white;
		}
		.content_left_item a:hover{
			background-color:#6B9525;
		}
		.content_rigth{
			margin-left: 200px; border: #ccc solid 1px;
		}
	</style>
</head>
<body>
	<div class="header">
		<div class="header_left"><span>LY'Bolg</span></div>
		<div class="header_right"><img src="<?php echo ($m_public); ?>/img/7.jpg" class="header_img" /><span class="header_right_user">LY</span><span class="header_right_exit">注销</span></div>
	</div>
	<div class="content">
		<div class="content_left">
			<ul class="content_left_item">
				<li ><a href="#" class="left_item_title" onclick="show_item(this); return false;">博文管理</a>
				<ul id="left_item_con_1">
					<li><a href="#">PHP</a></li>
					<li><a href="#">HTML/CSS</a></li>
					<li><a href="#">Linux</a></li>
					<li><a href="#">算法/数据结构</a></li>
					<li><a href="#">七七八八</a></li>
				</ul>
				</li>
			</ul>
			<hr>
			<ul class="content_left_item">
				<li ><a href="#" class="left_item_title" onclick="show_item(this); return false;">留言</a>
				<ul id="left_item_con_1">
					<li><a href="#">新留言</a></li>
					<li><a href="#">已回复留言</a></li>
				</ul>
				</li>
			</ul>
			<hr>
			<ul class="content_left_item">
				<li ><a href="#" class="left_item_title" onclick="show_item(this); return false;">系统设置</a>
				<ul id="left_item_con_1">
					<li><a href="#">用户管理</a></li>
					<li><a href="#">。。。。</a></li>
					<li><a href="#">。。。。。</a></li>
					<li><a href="#">。。。。。</a></li>
					<li><a href="#">。。。。。</a></li>
				</ul>
				</li>
			</ul>
			<hr>
		</div>
		<div class="content_rigth">
			<div>
				<script id="container" name="content" type="text/plain">
        		这里写你的初始化内容
    			</script>
   		 		<!-- 配置文件 -->
			    <script type="text/javascript" src="<?php echo ($m_public); ?>/ueditor1/ueditor.config.js"></script>
			    <!-- 编辑器源码文件 -->
			    <script type="text/javascript" src="<?php echo ($m_public); ?>/ueditor1/ueditor.all.js"></script>
			    <!-- 实例化编辑器 -->
			    <script type="text/javascript">
			        var ue = UE.getEditor('container',{
			        	initialFrameWidth:500,
			        	initialFrameHeight:500
			        });
			    </script>
			</div>
		</div>
	</div>
	<div class="footer"></div>
</body>
</html>