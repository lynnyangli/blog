<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>Socialike</title>
<link rel="shortcut icon" type="image/x-icon" href="http://115.28.12.36/Home2/public/style/images/favicon.png" />
<link rel="stylesheet" type="text/css" href="<?php echo ($PUBLIC_PATH); ?>/style/css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo ($PUBLIC_PATH); ?>/style/css/prettyPhoto.css"  />
<link rel="stylesheet" type="text/css" href="<?php echo ($PUBLIC_PATH); ?>/style/type/classic.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo ($PUBLIC_PATH); ?>/style/type/goudy.css" media="all" />
<script type="text/javascript" src="<?php echo ($PUBLIC_PATH); ?>/style/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="<?php echo ($PUBLIC_PATH); ?>/style/js/superfish.js"></script>
<script type="text/javascript" src="<?php echo ($PUBLIC_PATH); ?>/style/js/jquery.prettyPhoto.js"></script>
<style type="text/css">
	.post-img{
		display:block; margin:0 auto;
		border-radius: 
	}
	.icon-text h1{
		color:white;
		line-height:40px;
	}
</style>
<script src="/Admin/public/ueditor1/ueditor.parse.js"></script>
 	<script type="text/javascript">
 		/*uParse("#content",{
 			rootPath:"/Admin/public/ueditor1/"
 		});*/
 	</script>
</head>
<body>
<div id="body-wrapper"> 
  <!-- Begin Header -->
  <div id="header">
    <div class="logo">
      <a href="index.html"><img src="<?php echo ($PUBLIC_PATH); ?>/style/images/logo.png"  alt="" /></a>
    </div>

    <!-- Begin Menu -->
    <div class="menu">
      <ul class="sf-menu">
        <li><a href="/index.php/Home2/">Home</a></li>
	<?php if(is_array($CLASS)): foreach($CLASS as $key=>$vo): ?><li><a href="/index.php/Home2/ChangeClass/index/class/<?php echo ($vo); ?>"><?php echo ($vo); ?></a>
        </li><?php endforeach; endif; ?>
      </ul>
    </div>
    <div class="clear"></div>
    <!-- End Menu --> 
    
  </div>
  <!-- End Header --> 
  
  
  
  <!-- Begin Wrapper -->
  <div id="wrapper">
  
   <div class="intro"><?php echo ($DATA["title"]); ?></div>
   
  	<!-- Begin Container -->
  	<div class="container">
  
    
    <div class="post text">
    <div class="content">
    	<div class="top"></div>
    	<div class="middle">
    		<div class="post-text">
    			<h2 class="title"><a href="#"><?php echo ($DATA["title"]); ?></a></h2>
    			<p><?php echo ($DATA["description"]); ?>
				</p>
			<div id="content">
				<?php echo ($DATA["content"]); ?>
			</div>
    		</div>
    		<div class="meta-wrapper">
			<div class="meta">
    			<ul class="post-info">
    				<li><span class="post-link"></span><a href="#"><?php echo ($DATA["time"]); ?></a></li>
    				<li><span class="post-comment"></span><a href="#"><?php echo ($DATA["comment_sum"]); ?></a></li>
    				<li><span class="post-search"></span><a href="#"><?php echo ($DATA["read_sum"]); ?></a></li>
    				<li><span class="post-tag"></span><a href="#"><?php echo ($DATA["class"]); ?></a></li>
    			</ul>
    			<div class="share"><span class="post-share"></span><a href="#">Share</a></div>
    			<div class="clear"></div>
    		</div>
    		</div>
    	</div>
    	<div class="bottom"></div>
    </div>
    </div>
    </foreach>
        

    
    <!-- Begin Page Navi -->
    <!-- End Page Navi -->
    
	</div> <!-- End Container -->
	
	<div class="sidebar">
	
		<div class="sidebox">
			<h3 class="line">About</h3>
			<p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit. Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
			<br />
			<p>Amet risus nullam quis risus eget urna mollis ornare vel eu leo. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. </p>
		</div>
		
		<div class="sidebox">
			<h3 class="line">Friend Links</h3>
			<ul class="popular-posts">
 <?php if(is_array($LINK_DATA)): foreach($LINK_DATA as $key=>$vo): ?><li> <h5> <a href="<?php echo ($vo["link"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a></h5></li><?php endforeach; endif; ?>

			</ul>
		</div>
		
		
		<div class="sidebox">
			<h3 class="line">Categories</h3>
			<ul class="cat-list">
				<?php if(is_array($CLASS_SUM)): foreach($CLASS_SUM as $key=>$vo): ?><li><a href="#"><?php echo ($vo["name"]); ?> (<?php echo ($vo["sum"]); ?>)</a></li><?php endforeach; endif; ?>
			</ul>
		</div>
		
		<div class="sidebox">
			<h3 class="line">Search</h3>
			<form class="searchform" method="get">
          		<input type="text" id="s" name="s" value="type and hit enter" onfocus="this.value=''" onblur="this.value='type and hit enter'"/>
        	</form>
		</div>
		
	</div>
    <div class="clear"></div>
    
  </div>
  <!-- End Wrapper -->
  
  <div class="push"></div>
</div>
<!-- End Body Wrapper -->

<div id="footer">
  <div class="footer">
    <p>Copyright &copy; 2011 Socialike. All Rights Reserved.Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">LY</a></p>
  </div>
</div>
<script type="text/javascript" src="<?php echo ($PUBLIC_PATH); ?>/style/js/scripts.js"></script>
</body>
</html>