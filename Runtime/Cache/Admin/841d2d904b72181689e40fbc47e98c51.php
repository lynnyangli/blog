<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="login-bg">
<head>
	<title>Admin Login</title>
    
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
    <link rel="stylesheet" type="text/css" href="<?php echo ($PUBLIC_PATH); ?>/css/lib/font-awesome.css" />
    
    <!-- this page specific styles -->
    <link rel="stylesheet" href="<?php echo ($PUBLIC_PATH); ?>/css/compiled/signup.css" type="text/css" media="screen" />

    <!-- open sans font -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	
	<script language="JavaScript">

		function change()
		{
			var verify=document.getElementById('safecode');
			verify.setAttribute('src','/index.php/Admin/GetVerify?'+Math.random());
		}
	</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
    <div class="header">
        <a href="index.html">
            <img src="<?php echo ($PUBLIC_PATH); ?>/img/logo.png" class="logo" />
        </a>
    </div>
    <div class="row-fluid login-wrapper">
        <div class="box">
            <div class="content-wrap">
                <h6>登陆</h6>
		 <form action="/index.php/Admin/DoAdminLogin" method="post" enctype="multipart/form-data" />
                <input class="span12" type="text" placeholder="用户名" name="name"/>
                <input class="span12" type="password" placeholder="密码" name="password"/>
                <input class="span5" type="text" placeholder="验证码" style="float:left" name="verify"/><img src="/index.php/Admin/GetVerify" onclick="change()" id="safecode"/>
                <div class="action">
                   <input type="submit" class="btn-glow primary" value="提  交" />
                </div>
				</form>
            </div>
        </div>

        <div class="span4 already">
            <p>忘记密码了吗？</p>
            <a href="signin.html">活该</a>
        </div>
    </div>

	<!-- scripts -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="<?php echo ($PUBLIC_PATH); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo ($PUBLIC_PATH); ?>/js/theme.js"></script>
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>