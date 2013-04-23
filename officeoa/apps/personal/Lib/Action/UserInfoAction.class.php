<?php
class UserInfoAction extends BaseAction {
	public function _initialize() {
			parent :: base();
			
	}
    public function index(){
    	
    	$user=$this->api->PersonalUserInfo_getUserInfo($this->usersession['userid']);
    	if(empty($user)){
    		$this->error('请重试！');
    		exit;
    	}
    	$deptname=$this->api->PersonalUserInfo_getDeptName(intval($user['deptid']));
	    $positionname=$this->api->PersonalUserInfo_getPositionName(intval($user['positionid']));
    	$user['deptname']=$deptname;
    	$user['positionname']=$positionname;
    	$this->assign('user',$user);
    	$this->display();
    }
    public function updateUser(){
    	$userid=$this->usersession['userid'];
    	$mobile=htmlspecialchars($_POST['mobile']);
    	$tel=htmlspecialchars($_POST['tel']);
    	$email=htmlspecialchars($_POST['email']);
    	$address=htmlspecialchars($_POST['address']);
    	$data['mobile']=$mobile;
    	$data['tel']=$tel;
    	$data['email']=$email;
    	$data['address']=$address;
		$this->api->PersonalUserInfo_updateUser($userid,$data);    	
    	
    }
}