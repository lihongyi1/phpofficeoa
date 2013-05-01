<?php if (!defined('THINK_PATH')) exit();?>		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

<script>
$(function(){
	$('#width ul.subnav a').click(function(){
		$.post(
				'__ROOT__/index/index.php?s=/Index/changeWidth',
				{'width':$(this).attr('id')},
				function(data){
						window.location.reload(true);
					}
				)
	})
	$('#style ul.subnav a').click(function(){
		$.post(
				'__ROOT__/index/index.php?s=/Index/changeTheme',
				{'theme':$(this).attr('id')},
				function(data){
						window.location.reload(true);
					}
				)
	})
	$('#user ul.subnav a').click(function(){
		window.location.href='__ROOT__/index/index.php?s=/Index/logout';
	})
	
})
</script>
<body>

<!-- Start: Page Wrap -->
<div id="wrap" class="container_24">
	
	
	<!-- Header Grid Container: Start -->
	<div class="grid_24">
		
		<!-- User Panel: Start -->
		<div id="userpanel">
			
			<!-- User: Start -->
			<ul id="user" class="dropdown">
				<li class="topnav">
					<!-- User Name -->
					<a href="#" class="top icon user"><?php echo ($usersession['realname']); ?></a>
					
					<!-- User Dropdown Content: Start -->
					<ul class="subnav">  
			            <li><a href="forms.html" class="icon users">维护中心</a></li> 
			            <li><a href="#" class="icon lock">注销</a></li>  
			        </ul>  
			        <!-- User Dropdown Content: End -->
				</li>
			</ul>
			<!-- User: End -->
			
			<!-- Messages: Start -->
			<ul class="messages">
				<!-- Messages amount with Popup and Tip -->
				<li><a href="__ROOT__/info/index.php?s=/Info/index" class="newmsg tip " title="信息"> <span><?php echo ($countmsg); ?></span></a></li>
			</ul>
			<!-- Messages: End -->
			
			<!-- Style (Themes) Switcher: Start -->
			<ul id="style" class="dropdown right">
				<li class="topnav">
					<a href="#" class="top icon brush">主题</a>
					
					<!-- Style (Themes) Switcher Content: Start -->
					<ul class="subnav"> 
						<?php if(is_array($Themes)): $i = 0; $__LIST__ = $Themes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i; if($theme == $t): ?><li><a href="#" id="<?php echo ($t); ?>" class="icon circle selected"><?php echo ($Themes_zh[$key]); ?></a></li>
							<?php else: ?>
								 <li><a href="#" id="<?php echo ($t); ?>" class="icon circle"><?php echo ($Themes_zh[$key]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?> 
			        </ul>  
			        <!-- Style (Themes) Switcher Content: End -->
				</li>
			</ul>
			<!-- Style Switcher: End -->
			
			<!-- Width Switcher: Start -->
			<ul id="width" class="dropdown right">
				<li class="topnav">
					<a href="#" class="top icon coverflow">宽度</a>
					
					<!-- Width Switcher Content: Start -->
					<ul class="subnav">
						<?php if(is_array($Widths)): $i = 0; $__LIST__ = $Widths;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$w): $mod = ($i % 2 );++$i; if($width == $w): ?><li><a href="#" id="<?php echo ($w); ?>" class="icon coverflow selected"><?php echo ($Widths_zh[$key]); ?></a></li>
							<?php else: ?>
								 <li><a href="#" id="<?php echo ($w); ?>" class="icon coverflow"><?php echo ($Widths_zh[$key]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>   
			        </ul>  
			        <!-- Width Switcher Content: End -->
				</li>
			</ul>
			<!-- Width Switcher: End -->
			
		</div>
		<!-- User Panel: End -->
		<!-- Header: Start -->
		<div id="header">	
			<!-- Logo: Start -->
			<a href="__ROOT__/index/index.php" id="logo">乐丰办公OA</a>
			<!-- Logo: End -->
			
			<!-- Navigation: Start -->
			<ul id="navigation" class="dropdown">
				
				<!-- Navigation Dropdown Menu Item: Start -->
				<li class="topnav">
					<?php if(APP_NAME == personal): ?><a class="frames active" href="__ROOT__/personal/index.php">个人中心</a>
					<?php else: ?>
						<a class="frames" href="__ROOT__/personal/index.php">个人中心</a><?php endif; ?>
					
					<!-- Navigation Dropdown Menu Item Content: Start -->
					<ul class="subnav">
						<li><a href="__ROOT__/personal/index.php?s=/UserInfo/index" class="icon user">个人信息</a></li>
						<li><a href="__ROOT__/personal/index.php?s=/AddressList/index" class="icon typography">通讯录</a></li> 
			            <li><a href="__ROOT__/personal/index.php?s=/Working/index" class="icon blocks">日程安排</a></li>  
			        </ul> 
			        <!-- Navigation Dropdown Menu Item Content: End --> 
				</li>
				<!-- Navigation Dropdown Menu Item: End -->
				
				<!-- Navigation Dropdown Menu Item: Start -->
				<li class="topnav">
					<?php if(APP_NAME == info): ?><a class="frames active" href="__ROOT__/info/index.php">信息中心</a>
					<?php else: ?>
						<a class="frames " href="__ROOT__/info/index.php">信息中心</a><?php endif; ?>
					
					<!-- Navigation Dropdown Menu Item Content: Start -->
					<ul class="subnav">
			            <li><a href="__ROOT__/info/index.php?s=/ElectronicInfo/index" class="icon pages">电子公告</a></li> 
			            <li><a href="__ROOT__/info/index.php?s=/InterInfo/index" class="icon pages">内部通知</a></li> 
			            <li><a href="__ROOT__/info/index.php?s=/DocumentInfo/index" class="icon pages">公文通知</a></li>
			            <li><a href="__ROOT__/info/index.php?s=/Info/index" class="icon pages">信息交流</a></li>
			            
			        </ul>  
			        <!-- Navigation Dropdown Menu Item Content: End --> 
			        
				</li>
				<!-- Navigation Dropdown Menu Item: End -->
				
				<!-- Navigation Dropdown Menu Item: Start -->
				<li class="topnav">
					<a class="frames" href="#">流转中心</a>
					
					<!-- Navigation Dropdown Menu Item Content: Start -->
					<ul class="subnav">
						<li><a href="typography.html" class="icon typography">电子流</a></li> 
			            <li><a href="grid.html" class="icon blocks">新建电子流</a></li>  
			        </ul> 
			        <!-- Navigation Dropdown Menu Item Content: End --> 
				</li>
				<!-- Navigation Dropdown Menu Item: End -->
				
					<!-- Navigation Dropdown Menu Item: Start -->
				<li class="topnav">
					<a class="frames " href="#">日常工作</a>
					
					<!-- Navigation Dropdown Menu Item Content: Start -->
					<ul class="subnav">
			            <li><a href="tabs.html" class="icon laptop">资料管理</a></li> 
			            <li><a href="tabs.html" class="icon laptop">办公用品申领</a></li> 
			            
			        </ul>  
			        <!-- Navigation Dropdown Menu Item Content: End --> 
			        
				</li>
				<!-- Navigation Dropdown Menu Item: End -->
				
				
				
			</ul>
			<!-- Navigation: End -->
			
		</div>
		<!-- Header: End -->
		<!-- Breadcrumb Bar: Start -->
		<div id="breadcrumb">
			
			<!-- Breadcrumb: Start -->
			<ul class="left">
				<li class="icon dashboard"><a href="__ROOT__/index/index.php">首页</a></li>
				<li class="icon point_right"><a href="__APP__">信息中心</a></li>
				<li class="icon point_right"><a href="__APP__/Info/index">信息交流</a></li>
			</ul>
			<!-- Breadcrumb: End -->
			<!-- Breadcrumb Icon Links: Start -->
			<ul class="right">
				<li><a href="#" class="icon support tip" title="当前日期">当前日期：</a></li>
				<li><a href="#" id="datetime" title="当前日期" style="color: #B0B0B0">当前日期</a></li>
				
			</ul>
			<!-- Breadcrumb Icon Links: End -->
			
		</div>
		<!-- Breadcrumb Bar: End -->
		
	</div>
	<!-- Header Grid Container: End -->
	
	
<!-- 25% Box Grid Container: Start -->
<div class="grid_6">

	<!-- Box Header: Start -->
	<div class="box_top">
		
		<h2 class="icon coverflow">信息中心</h2>
		
	</div>
	<!-- Box Header: End -->
	
	<!-- Box Content: Start -->
	<div class="box_content">
		
		<!-- Vertical Menu: Start -->
			<ul class="menu">
				<?php if(MODULE_NAME == ElectronicInfo): ?><li><a href="__ROOT__/info/index.php?s=/ElectronicInfo/index" class='active'><span class="icon pages"></span>电子公告</a><?php else: ?><li><a href="__ROOT__/info/index.php?s=/ElectronicInfo/index"><span class="icon pages"></span>电子公告</a><?php endif; ?>
				<?php if(MODULE_NAME == InterInfo): ?><li><a href="__ROOT__/info/index.php?s=/InterInfo/index" class='active'><span class="icon pages"></span>内部通知</a><?php else: ?><li><a href="__ROOT__/info/index.php?s=/InterInfo/index"><span class="icon pages"></span>内部通知</a><?php endif; ?>
				<?php if(MODULE_NAME == DocumentInfo): ?><li><a href="__ROOT__/info/index.php?s=/DocumentInfo/index" class='active'><span class="icon pages"></span>公文通知</a><?php else: ?><li><a href="__ROOT__/info/index.php?s=/DocumentInfo/index"><span class="icon pages"></span>公文通知</a><?php endif; ?>
				<?php if(MODULE_NAME == Info): ?><li><a href="__ROOT__/info/index.php?s=/Info/index" class='active'><span class="icon pages"></span>信息交流</a><?php else: ?><li><a href="__ROOT__/info/index.php?s=/Info/index"><span class="icon pages"></span>信息交流</a><?php endif; ?>
			</ul>
		<!-- Vertical Menu: End -->

	</div>
	<!-- Box Content: End -->
	
</div>
<!-- 25% Box Grid Container: End --> 

<!-- 75% Box Grid Container: Start -->
<div class="grid_18">

	<!-- Box Header: Start -->
	<div class="box_top padding">
		
		<h2 class="icon user">信息交流</h2>
		<ul class="sorting">
		<li>
		<a class="active" href="__APP__/Info/index">列表</a>
		</li>
		<li>
		<a class="" href="__APP__/Info/add">发送信息</a>
		</li>
		</ul>
	</div>
	<!-- Box Header: End -->
	
</div>	
<!-- 25% Box Grid Container: Start -->
<div class="grid_9">

	<!-- Box Header: Start -->
	<div class="box_top padding">
		<h2 class="icon user">发件箱</h2>
	</div>
	<!-- Box Header: End -->
	
	<!-- Box Content: Start -->
	<div class="box_content " style="overflow: auto;height: 400px">
		<table class="sorting">
			<thead>
				<tr>
					<th class="align_left center" style="width: 15%">收送人</th>
					<th class="align_left center">时间</th>
					<th class="align_left center ">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($sends)): $i = 0; $__LIST__ = $sends;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$send): $mod = ($i % 2 );++$i;?><tr>
						<td class="align_left center"><a href="__ROOT__/personal/index.php?s=/AddressList/userInfo/uid/<?php echo ($send['toid']['userid']); ?>/rid/" ><?php echo ($send['toid']['realname']); ?></a></td>
						<td class="align_left center"><?php echo ($send["ctime"]); ?></td>
						<td class="align_left  center">
							<a href="javascript:void(0)" rel='facebox' name="outbox" class="view tip" title="查看" id="<?php echo ($send["replyid"]); ?>">查看</a>
							<a href="javascript:void(0)" class="delete tip" title="删除" id="<?php echo ($send["id"]); ?>">删除</a>
						</td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				
				
			</tbody>
		</table> 
				
		

				
				
	</div>
		<!-- News Table Tabs: End -->
	<!-- Box Content: End -->

</div>	
<!-- 25% Box Grid Container: End -->

<!-- 25% Box Grid Container: Start -->
<div class="grid_9">

	<!-- Box Header: Start -->
	<div class="box_top ">
		<h2 class="icon user">收件箱</h2>
	</div>
	<!-- Box Header: End -->
	
	<!-- Box Content: Start -->
	<div class="box_content " style="overflow: auto;height: 400px">
		<table class="sorting">
			<thead>
				<tr>
					<th class="align_left center" style="width: 15%">发送人</th>
					<th class="align_left center">时间</th>
					<th class="align_left center ">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($receives)): $i = 0; $__LIST__ = $receives;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$receive): $mod = ($i % 2 );++$i;?><tr>
						<td class="align_left center"><a href="__ROOT__/personal/index.php?s=/AddressList/userInfo/uid/<?php echo ($receive['fromid']['userid']); ?>" ><?php echo ($receive['fromid']['realname']); ?></a></td>
						<td class="align_left center"><?php echo ($receive["ctime"]); ?></td>
						<td class="align_left  center">
							<?php if($receive["isread"] == 0): ?><a href="javascript:void(0)" rel='facebox' name="inbox" title="查看" id="<?php echo ($receive["replyid"]); ?>"><span class="icon mail"></span></a>
							<?php else: ?>
							<a href="javascript:void(0)" rel='facebox' name="inbox" class="view tip" title="查看" id="<?php echo ($receive["replyid"]); ?>">查看</a><?php endif; ?>
							
							<a href="javascript:void(0)" class="delete tip" title="删除"  id="<?php echo ($receive['id']); ?>">删除</a>
						</td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				
				
			</tbody>
		</table> 
		
				
				
	</div>
		<!-- News Table Tabs: End -->
	<!-- Box Content: End -->

</div>	
<!-- 25% Box Grid Container: End -->



<!-- Footer Grid: Start -->
<div class="grid_24" >

	<!-- Footer: Start -->
	<div id="footer">
		
		<p class="left">
			Copyright &#169; 2011 <a href="#">Yourcompany</a>. 
			Powered by <a href="/user/Kaasper/?ref=kaasper">Simplpan</a>.
		</p>
		
		<!-- Footer Icon Navigation: Start -->
		<ul class="right">
			<li><a href="#" class="icon dashboard tip active" title="Dashboard">Dashboard</a></li>
			<li><a href="#" class="icon pages tip" title="Pages">Pages</a></li>
			<li><a href="#" class="icon users tip" title="Users">Users</a></li>
			<li><a href="#" class="icon settings tip" title="Settings">Settings</a></li>
			<li><a href="#" class="icon support tip" title="Support">Support</a></li>
			<li><a href="#" class="icon home tip" title="Home">Home</a></li>
		</ul>
		<!--Footer Icon Navigation: End -->
		
	</div>
	<!-- Footer: End -->
	
</div>
<!-- Footer Grid: End -->
</div>

<input type="hidden" id="public_url" value='PUBLIC_URL'/>
<script type="text/javascript" src="PUBLIC_URL/js/jquery.facebox.js"></script>

	<script type="text/javascript">
		$(function(){
			var mydate=new Date();
			var week=new Array('星期日','星期一','星期二','星期三','星期四','星期五','星期六');
			$("#datetime").html(mydate.getFullYear()+" 年 "+(mydate.getMonth()+1)+" 月 "+mydate.getDate()+" 日 "+week[mydate.getDay()]);
			
			$("<span class='v'></span>").insertBefore("#userpanel ul.dropdown ul.subnav");
			
			// Inserts the "v" Icon
			$("<span class='v'></span>").insertAfter("ul#navigation.dropdown ul.subnav");
			$("#userpanel ul.dropdown").hover(function() { 
				  
				// Sets the top text as active (the dropdown)
				$(this).find(".top").addClass("active");
				
				// Slides the "subnav" on hover
				$(this).find("ul.subnav").show();
				// Shows the white 'v'
				$(this).find("span.v").addClass("active");
			  
				// On hover off
				$(this).hover(function() {  
				}, function(){  
					
					// Hides the subnavigation when isn't on the "subnav" anymore
					$(this).find("ul.subnav").stop(false, true).hide(); 
					
					// Removes top text as active (the dropdown)
					$(this).find(".top").removeClass("active");
					
					// Hides the white 'v'
					$(this).find("span.v").removeClass("active");
				});  
			});  
			$("ul#navigation.dropdown li.topnav").hover(function() { 
						
						// Copys the navigation name and the "v" icon to the top of the dropdown
						$(this).clone().prependTo("ul#navigation.dropdown .subnav");
						$("ul#navigation.dropdown .subnav .subnav").remove();	
						
						// Slides the "subnav" on hover
						$(this).find("ul.subnav").show();
						
						// On hover off
						$("ul#navigation.dropdown ul.subnav").parent().hover(function() {  
						}, function(){  
							
							// Hides the subnavigation when isn't on the "subnav" anymore
							$(this).find("ul.subnav").stop(false, true).hide(); 
							
							// Removes the top part to prevent duplication
							$("ul#navigation.dropdown .subnav .topnav").remove();
						});  
					});  
			$('.popup').facebox();
			$(".box_top h2").click(function(){
				$(this).toggleClass("toggle_closed").parent().next().slideToggle("slow");
				return false; //Prevent the browser jump to the link anchor
			}); 
			
	})
	</script>
</body>
</html>
<script>
$(function(){
	$(".sorting td a[name='inbox']").click(function(){
			$this=$(this);
			var id=$(this).next().attr('id');
			$.post(
					"__APP__/Info/setread",
					{'id':id},
					function(data){
						//alert(data);
						if(data==1){
							$this.addClass('view tip');
							$this.html('查看');
						}		
					})
	       	$.facebox({ajax:'__APP__/Info/viewinbox/rid/'+$(this).attr('id')});
		})
	$(".sorting td a[name='outbox']").click(function(){
	       	$.facebox({ajax:'__APP__/Info/viewoutbox/rid/'+$(this).attr('id')});
		})
	$('.delete.tip').click(function(){
		$this=$(this);
			$.post(
					"__APP__/Info/delete",
					{'id':$(this).attr('id')},
					function(data){
							if(data=='success'){
									$this.parents('tr').remove();
								}
						})
		})
	
})
</script>