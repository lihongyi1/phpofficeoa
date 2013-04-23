<?php if (!defined('THINK_PATH')) exit();?><!-- Box Content: Start -->
	<div class="box_content" style="width: 600px">
		<div class="field" >
			<label class="left " style="margin-top: 10px">公司部门：</label>
			<select style="margin-top: 10px" id="sdept">
				<option value="0">公司部门</option>
				<?php if(is_array($depts)): $i = 0; $__LIST__ = $depts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dept): $mod = ($i % 2 );++$i;?><option value="<?php echo ($dept['deptid']); ?>"><?php echo ($dept['deptname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
			<input type="text" class="right" id="search"> 
			<label class="right">搜　　索：</label>
		</div>
		<!-- Simple Sorting Table + Pagination: Start -->
		<div  style="overflow: auto; height: 300px;width: 600px" >
		<table>
			<thead>
				<tr >
				<th class="checkers"><input type="checkbox" class="checkAll" /></th>
					<th>部门</th>
					<th>姓名</th>
					<th>登录名</th>
					<th>职务</th>
				</tr>
			</thead>
			<tbody id="usercontent">
				
				<?php if(is_array($users)): $i = 0; $__LIST__ = $users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
					<td class="checkers"><input type="checkbox" class="checkOne" id="<?php echo ($user['userid']); ?>" <?php if(in_array($user['userid'],$ids)){ ?> checked="checked" <?php } ?>/></td>
					<td><?php echo ($user['deptname']['deptname']); ?></td>
					<td><a target="_blank" href="__ROOT__/personal/index.php?s=/AddressList/userInfo/uid/<?php echo ($user['userid']); ?>"  class="realname"><?php echo ($user['realname']); ?></a></td>
					<td class="username"><?php echo ($user['username']); ?></td>
					<td><?php echo ($user['position']['position']); ?></td>
					
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				
			</tbody>
		</table>
		<!-- Sorting Table: End -->
		</div>
		<div class="field" align="center">
			<div class="button" style="-moz-user-select: none;">
			<span>
			提交
			<button style="opacity: 0;" id="submit">提交</button>
			</span>
			</div>
			<div class="button" style="-moz-user-select: none;">
			
			</div>
		</div>

	</div>
	<!-- Box Content: End -->
	<script>
	$('#search').keyup(function(){
		var ids=new Array();
		$('.sorting tr :hidden').each(function(){
				ids.push($(this).val());
		})
			$.post(
					"__APP__/Info/search",
					{'info':$(this).val(),'ids[]':ids},
					function(data){
						//alert(data);
						$(':checkbox').removeProp('checked');
						$('#usercontent').html(data);	
					}
					)
		})
	$('#sdept').change(function(){
		var ids=new Array();
		$('.sorting tr :hidden').each(function(){
				ids.push($(this).val());
		})
			$.post(
					"__APP__/Info/searchbyDept",
					{'dept':$(this).val(),'ids[]':ids},
					function(data){
						$(':checkbox').removeProp('checked');
						$('#usercontent').html(data);	
					}
					)
		})
		$('.checkAll').click(function(){
			if(this.checked){
				$(':checkbox').prop('checked',true);
			}else{
				$(':checkbox').removeProp('checked');
			}
		})
	$('.checkOne').click(function(){
			if(this.checked){
				$(this).prop('checked',true);
			}else{
				$(this).removeProp('checked');
				$('.checkAll').removeProp('checked');
				}
			var flag=true;
			$('.checkOne').each(function(){
					if(!this.checked){
						flag=false;
						return;
					}
				})
			if(flag){
				$(':checkbox').prop('checked',true);
				}
		//	alert($('.checkOne :checked').length);
		})
		$('#submit').click(function(){
			var ids=new Array();
			$('.sorting tr :hidden').each(function(){
					ids.push($(this).val());
			})
				$('.checkOne').each(function(){
					if(this.checked){
					//	if($('.sorting tr :hidden').val())
						var id=$(this).attr("id");
						if($.inArray(id,ids)==-1){
						
						var realname=$(this).parents('tr').find('.realname').html();
						var username=$(this).parents('tr').find('.username').html();
						$('.sorting tbody').append('<tr><td ><input type="hidden" value="'+id+'"/><span class="icon user"></span><a href="__ROOT__/personal/index.php?s=/AddressList/userInfo/uid/'+id+'" target="_blank">'+realname+'('+username+')</a></td><td><a href="javascript:void(0)" class="delete tip new" title="删除">删除</a></td></tr>');
						}
					}
					})
			})
			
</script>