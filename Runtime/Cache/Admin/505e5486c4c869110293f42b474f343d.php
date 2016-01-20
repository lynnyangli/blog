<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<title>Login</title>
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
		margin-left: 36%;
		
	}
	#log{
		height:60px;
		width:60px;  
		float:left;
		margin-left:20px;
	}
	#content{
		width: 50%;
		margin-top:5%; 
		margin-left: auto;
		margin-right: auto;
    	text-align:left;
    	background-color: #eee;
    	border: solid #ddd 2px;
    	color:#4FC3C7;
    	border-radius: 0.5em;
	}
	 #fm{
		margin:6px;
		background-color: black;
		font-size: 1.3em;
		text-align: left;
		line-height: 60px;
		font-family: "微软雅黑";
		position:relative;
		color: green;
	 }
	 #fm input{
	 	font-family: "微软雅黑";
	 	font-size: 0.8em;
	 	width: 150px;
	 	margin: 0 5px;
	 }
</style>
</head>
<body>
	<div id='header'>
		<img id='log' src='<?php echo ($m_public); ?>/img/log_1.png' />
		<span>LY的私人领地</span>
	</div>
	<div id='content'>
		<p>
		<form action="#" method="post" id='fm'>
			>1:&nbsp;&lt;form&nbsp;action="#"&nbsp;method="post"&gt;<br />
			>2:&nbsp;&lt;input type='text'&nbsp;name='user' value='<input tpye='text' name='user'>'&gt;<br />
			>3:&lt;input type='password' name='pwd' value='<input type="password" name="pwd">'&gt;<br />
			>4:&lt;input type='submit' value='<input type="submit" value="Login">'&gt;<br />
			>5:&nbsp;&lt;/form&gt;
		</form>
		</p>
	</div>
</body>
</html>