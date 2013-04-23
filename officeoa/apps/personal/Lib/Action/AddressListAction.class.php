<?php
class AddressListAction extends BaseAction {
	public function _initialize() {
			parent :: base();
			
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
    public function userInfo(){
    	
    	$userid=intval($_GET['uid']);
    	if($userid==$this->usersession['userid']){
    		$this->redirect('UserInfo/index');
    	}else{
    		$user=$this->api->PersonalUserInfo_getUserInfo($userid);
	    	if(empty($user)){
	    		$this->error('请重试！');
	    		exit;
	    	}
	    	$deptname=$this->api->PersonalUserInfo_getDeptName(intval($user['deptid']));
	    	$positionname=$this->api->PersonalUserInfo_getPositionName(intval($user['positionid']));
	    	$user['deptname']=$deptname;
	    	$user['positionname']=$positionname;
	    	$this->assign('user',$user);
    		$this->assign('user',$user);
    		$this->display('info');
    	}
    	
    }
    public function search(){
    	$search=trim($_POST['info']);
    	$users=$this->api->PersonalAddressList_getAllUsers(addslashes($search));
    	$html="";
    	foreach ($users as $key=>$user) {
    		$user['deptname']=$this->api->PersonalUserInfo_getDeptName($user['deptid']);
    		$user['position']=$this->api->PersonalUserInfo_getPositionName($user['positionid']);
    		$html.='<tr>';
    		$html.='<td>'.htmlspecialchars($user["deptname"]['deptname']).'</td>';
    		$html.='<td><a href="'.__APP__.'/AddressList/userInfo/uid/'.intval($user['userid']).'">'.htmlspecialchars($user["realname"]).'</a></td>';
    		$html.='<td>'.htmlspecialchars($user["position"]['position']).'</td>';
    		$html.='<td>'.htmlspecialchars($user["tel"]).'</td>';
    		$html.='<td>'.htmlspecialchars($user["email"]).'</td>';
    		$html.='</tr>';
    	}
    	if(empty($html)){
    		$html='<tr><td colspan="5" ><a>没有符合条件的搜索结果。</a></td></tr>';
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
    		$html.='<td>'.htmlspecialchars($user["deptname"]['deptname']).'</td>';
    		$html.='<td><a href="'.__APP__.'/AddressList/userInfo/uid/'.intval($user['userid']).'">'.htmlspecialchars($user["realname"]).'</a></td>';
    		$html.='<td>'.htmlspecialchars($user["position"]['position']).'</td>';
    		$html.='<td>'.htmlspecialchars($user["tel"]).'</td>';
    		$html.='<td>'.htmlspecialchars($user["email"]).'</td>';
    		$html.='</tr>';
    	}
    	if(empty($html)){
    		$html='<tr><td colspan="5" align="center"><a>没有符合条件的搜索结果。</a></td></tr>';
    	}
    	echo $html;
    }
}