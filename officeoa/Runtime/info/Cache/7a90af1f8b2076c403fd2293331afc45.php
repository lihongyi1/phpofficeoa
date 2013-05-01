<?php if (!defined('THINK_PATH')) exit();?>			<!-- Messages Popup Content: Start -->
			<div class="box_content padding " id="messages" style="overflow: auto;height:400px">
					<!-- Message From User: Start -->
					<?php if(is_array($msgs)): $i = 0; $__LIST__ = $msgs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$msg): $mod = ($i % 2 );++$i;?><h6>
						<span class="icon user"></span> <a href="javascript:void(0)"><?php if($msg['toid']['userid'] == $usersession['userid']): ?>我<?php else: echo ($msg['toid']['realname']); endif; ?></a> <span class="nobold">说：</span>
						<small class="right grey nobold"><?php echo ($msg["ctime"]); ?></small> 
					</h6>
					<p>
						<?php echo ($msg["content"]); ?>
					</p><?php endforeach; endif; else: echo "" ;endif; ?>
					<!-- Message From User: End -->
					
					<!-- Quick Reply: Start -->
					<div class="field">
						<label>
							<span class="icon chatbubbles"></span>
							回复
						</label>
						<textarea cols="30" rows="7" id="replyoutbox"></textarea>
					</div>
				  
				  <button class="replyoutbox">发送</button>
				  <button class="secondary" type="reset">重置</button>
				  <!-- Quick Reply: End -->
				  
			</div>
			<!-- Messages Popup Content: End -->
<script>
$('.replyoutbox').click(function(){
	var rid='<?php echo ($rid); ?>';
	$.post(
			"__APP__/Info/reply",
			{'rid':rid,'content':$('#replyoutbox').val()},
			function(data){
					alert(data);
				})
})
</script>