<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>乐丰办公oa</title>
	
	<!-- Imports General CSS and jQuery CSS -->
	<link href="PUBLIC_URL/css/screen.css" rel="stylesheet" media="screen" type="text/css" />

	<!-- CSS for Fluid and Fixed Widths - Double to prevent flickering on change -->
	<link href="PUBLIC_URL/css/<?php echo ($width); ?>.css" rel="stylesheet" media="screen" type="text/css" />
	<link href="PUBLIC_URL/css/<?php echo ($width); ?>.css" rel="stylesheet" media="screen" type="text/css" class="width" />
	
	
	<!-- CSS for Theme Styles - Double to prevent flickering on change -->
	<link href="PUBLIC_URL/css/theme/<?php echo ($theme); ?>.css" rel="stylesheet" media="screen" type="text/css" />
	<link href="PUBLIC_URL/css/theme/<?php echo ($theme); ?>.css" rel="stylesheet" media="screen" type="text/css" class="theme" />
	<!-- jQuery thats loaded before document ready to prevent flickering - Rest are found at the bottom -->
	<script type="text/javascript" src="PUBLIC_URL/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript">
	$(function(){
		$('div .notice').click(function(){
			$(this).fadeOut('slow');
		})
		})
	</script>
</head>

<script type="text/javascript" src="PUBLIC_URL/js/jquery.form.js"></script>
<script type="text/javascript">
$(function(){
	$('#login').ajaxForm(function(data){
			
			if(data=='error'){
				$('div.notice').fadeOut('slow');
				$('div.notice').fadeIn('slow');
				$('div.notice p').html('用户名密码错误，请重新输入！');
				}else if(data=='success'){
						window.location.href='__APP__/Index/index';
					}
			return false;
		})
		
})
</script>
<body>

<!-- Start: Page Wrap -->
<div id="wrap" class="container_24">

	<!-- Header Grid Container: Start -->
	<div class="login">
		
	<!-- Info Notice: Start -->
	<div class="notice info">
		<p>请输入用户名及密码后登陆</p>
	</div>
	<!-- Info Notice: End -->
	
		<!-- Header: Start -->
		<div id="header">
				
			<!-- Logo: Start -->
			<a href="#" id="logo">乐丰办公oa</a>
			<!-- Logo: End -->
			<!-- Login: Start -->
			<form action="__APP__/Login/dologin" method="post" id="login">
				
				<!-- Username Input: Start -->
				<label for="username" class="label_username">User</label>
				<input type="text" name="username" value="username" id="username" class="password tip-stay validate" title="请输入用户名" />
				<!-- Username Input: End -->
				
				<!-- Password Input: Start -->
				<label for="password" class="label_password">Password</label>
				<input type="password" name="password" value="password" id="password" class="password tip-stay validate" title="请输入密码" />
				<!-- Password Input: End -->
				
				<!-- Login Button: Start -->
				<input type="submit" value="login" class="tip" title="登陆" />
				<!-- Login Button: End -->
				
			</form>
			<!-- Login: End -->
			
		</div>
		<!-- Header: End -->
		
		<!-- Breadcrumb Bar: Start -->
		<div id="breadcrumb">
			
			<!-- Breadcrumb: Start -->
			<ul class="left">
				<li class="icon key"><a href="mailto:">如有问题请联系管理员</a></li>
			</ul>
			
			<!-- Breadcrumb: End -->
			
			<!-- Breadcrumb Icon Links: Start -->
			
			<!-- Breadcrumb Icon Links: End -->
			
		</div>
		<!-- Breadcrumb Bar: End -->
		
	</div>
	<!-- Header Grid Container: End -->

</div>


</body>
</html>