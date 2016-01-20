<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<title>welcome</title>
<meate http-equiv='conten-type' content="text/html;charset=utf-8">
<style type="text/css">
	*{
		margin: 0px;
		padding: 0px;
		
	}
	#header{
		height:60px;
		width: 100%;
		background-color: #eee;
	}
	#header>span{
		font-size: 2em;
		height: 60px;
		text-align: center;
		line-height:62px;
		font-family: '微软雅黑';
		margin-left: 25%;
		
	}
	#log{
		height:60px;
		width:60px;  
		float:left;
		margin-left:20px;
	}
	
	#content>img{
		height: 90%;
		width:50%;
		float: left;
	}
	#con_2{
		float: left;
		width: 40%;
		margin: auto;
		position:relative;
    	left:60px;
    	top:100px;
    	text-align: center;
    	background-color: #eee;
    	border: solid #ddd 2px;
    	color:#4FC3C7;
    	border-radius: 0.5em;
	}
	#con_2>a>img{
		height: 50px;
		width: 150px;
		margin-top: 56px;
		position:absolute;
   		bottom:-80px;
   		left:0px;
	}
	 p{
		margin:6px;
		background-color: white;
		font-size: 1.6em;
		text-align: left;
		line-height: 56px;
		font-family: "华文彩云";
		position:relative;
	 }
</style>
</head>
<body>
	<div id='header'>
		<img id='log' src='<?php echo ($m_public); ?>/img/log_2.png' />
		<span>只做第一个我，不做第二个谁——LY</span>
	</div>
	<div id='content'>
		<img src="<?php echo ($m_public); ?>/img/bg_book.jpg">
		<div id='con_2'>
			 <p>
			 	“这位同学，请问你知道《边城》吗？”<br />“呸！别跟我提编程，老子这辈子最讨厌的就是编程！”
			 </p>
			 <a id='go' href=""><img src="<?php echo ($m_public); ?>/img/btn_5.png"></a>
		</div>

	</div>
</body>
</html>