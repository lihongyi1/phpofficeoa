<?php 
class ManageUserAction extends BaseAction{
	public function _initialize() {
	   		parent::base();
	}
	public function index(){
		$depts=$this->api->PersonalAddressList_getAllDepts();
    	$users=$this->api->PersonalAddressList_getAllUsers();
    	foreach ($users as $key=>$user) {
    		$user['deptname']=$this->api->PersonalUserInfo_getDeptName($user['deptid']);
    		$user['position']=$this->api->PersonalUserInfo_getPositionName($user['positionid']);
    		$users[$key]=$user;
    	}
    	$this->assign('depts',$depts);
    	$this->assign('users',$users);
		$this->display();
	}
   public function search(){
    	$search=trim($_POST['info']);
    	$users=$this->api->PersonalAddressList_getAllUsers(addslashes($search));
    	$html="";
    	foreach ($users as $key=>$user) {
    		$user['deptname']=$this->api->PersonalUserInfo_getDeptName($user['deptid']);
    		$user['position']=$this->api->PersonalUserInfo_getPositionName($user['positionid']);
    		$html.='<tr>';
    		$html.='<td><a href="'.__ROOT__.'/personal/AddressList/userInfo/uid/'.intval($user['userid']).'">'.htmlspecialchars($user["realname"]).'</a></td>';
    		$html.='<td>'.htmlspecialchars($user["username"]).'</td>';
    		$html.='<td>'.htmlspecialchars($user["deptname"]['deptname']).'</td>';
    		$html.='<td class="align_left center tools">
					<a href="__APP__/ManageUser/userInfo/uid/'.$user["userid"].'"  class="edit tip" title="编辑">编辑</a>
					<a href="#" id="'.$user["userid"].'"  class="view tip" title="权限">权限</a>
					<a href="#" id="'.$user["userid"].'"  class="delete tip" title="删除">删除</a>
					</td>';
    		$html.='</tr>';
    	}
    	if(empty($html)){
    		$html='<tr><td colspan="4" ><a>没有符合条件的搜索结果。</a></td></tr>';
    	}
    	echo $html;
    }
    public function searchbyDept(){
    	$dept=intval(trim($_POST['dept']));
    	$users=$this->api->PersonalAddressList_getUsersByDept($dept);
    	$html="";
    	foreach ($users as $key=>$user) {
    		$user['deptname']=$this->api->PersonalUserInfo_getDeptName($user['deptid']);
    		$user['position']=$this->api->PersonalUserInfo_getPositionName($user['positionid']);
    		$html.='<tr>';
    		$html.='<td><a target="_blank" href="'.__ROOT__.'/personal/AddressList/userInfo/uid/'.intval($user['userid']).'">'.htmlspecialchars($user["realname"]).'</a></td>';
    		$html.='<td>'.htmlspecialchars($user["username"]).'</td>';
    		$html.='<td>'.htmlspecialchars($user["deptname"]['deptname']).'</td>';
    		$html.='<td class="align_left center tools">
					<a href="__APP__/ManageUser/userInfo/uid/'.$user["userid"].'"  class="edit tip" title="编辑">编辑</a>
					<a href="#" id="'.$user["userid"].'"  class="view tip" title="权限">权限</a>
					<a href="#" id="'.$user["userid"].'"  class="delete tip" title="删除">删除</a>
					</td>';
    		$html.='</tr>';
    	}
    	if(empty($html)){
    		$html='<tr><td colspan="4" align="center"><a>没有符合条件的搜索结果。</a></td></tr>';
    	}
    	echo $html;
    }
	public function userInfo(){
    	
    	$userid=intval($_GET['uid']);
    		$user=$this->api->PersonalUserInfo_getUserInfo($userid);
	    	if(empty($user)){
	    		$this->error('操作失败，请重试！');
	    		exit;
	    	}
	    	$dept=$this->api->PersonalAddressList_getAllDepts();
	    	$postition=$this->api->ManageManageUser_getPosition($user['deptid']);
	    	$this->assign('depts',$dept);
	    	$this->assign('positions',$postition);
    		$this->assign('user',$user);
    		$this->display('info');
    }
    
    public function getPosition(){
    	$deptid=intval($_POST['deptid']);
    	$postition=$this->api->ManageManageUser_getPosition($deptid);
    	$html='<option value="0">请选择职务</potion>';
    	foreach ($postition as $p) {
    		$html.='<option value="'.$p['positionid'].'">'.$p['position'].'</option>';
    	}
    	echo $html;
    }
	public function updateUser(){
		$data['userid']=intval($_POST['userid']);
		$data['username']=htmlspecialchars($_POST['username']);
		$data['realname']=htmlspecialchars($_POST['realname']);
		$passwd=trim($_POST['passwd']);
		if(!empty($passwd)) 
		$data['passwd']=md5($passwd);
		$data['mobile']=htmlspecialchars($_POST['mobile']);
		$data['deptid']=intval(trim($_POST['deptid']));
		$data['positionid']=intval(trim($_POST['positionid']));
		$data['email']=strip_tags($_POST['email']);
		$data['tel']=htmlspecialchars($_POST['tel']);
		$data['address']=strip_tags($_POST['address']);
		$res=$this->api->ManageManageUser_updateUser($data);
		echo $res;
	}
	public function deleteUser(){
		$uid=intval($_GET['uid']);
		$res=$this->api->ManageManageUser_deleteUser($uid);
		if(empty($res)) $this->error('操作失败，请重试！');
		$this->redirect('index');
		//exit;
	}
	
	public function addUser(){
		$depts=$this->api->PersonalAddressList_getAllDepts(); 
		$this->assign('depts',$depts);
		$this->display('addUser');
	}
	public function doaddUser(){
		if(empty($_POST['username'])||empty($_POST['realname'])||empty($_POST['passwd'])) $this->error('操作失败，请重试');
		$data['username']=htmlspecialchars($_POST['username']);
		$data['realname']=htmlspecialchars($_POST['realname']);
		$passwd=trim($_POST['passwd']);
		$data['passwd']=md5($passwd);
		$data['mobile']=htmlspecialchars($_POST['mobile']);
		$data['deptid']=intval(trim($_POST['deptid']));
		$data['positionid']=intval(trim($_POST['positionid']));
		$data['email']=strip_tags($_POST['email']);
		$data['tel']=htmlspecialchars($_POST['tel']);
		$data['address']=strip_tags($_POST['address']);
		$res=$this->api->ManageManageUser_addUser($data);
		echo $res;
	}
}
?>