<?php 
class IndexAction extends BaseAction{
	public function _initialize() {
	   		parent::base();
	}
	public function index(){
		//dump($_SESSION['usersession']);
		$doc=$this->api->IndexIndex_getdoucument();
		$ele=$this->api->IndexIndex_getelectronic();
		$inter=$this->api->IndexIndex_getinter();
		$this->assign('doc',$doc);
		$this->assign('ele',$ele);
		$this->assign('inter',$inter);
		$this->display();
	}
	public function changeWidth(){
		$width=htmlspecialchars($_REQUEST['width']);
		$width=array_search($width,C('WIDTH'));
		$this->api->IndexIndex_changeWidth(intval($width),$this->usersession['userid']);
	}
	public function changeTheme(){
		$theme=htmlspecialchars($_REQUEST['theme']);
		$theme=array_search($theme,C('THEME'));
		$this->api->IndexIndex_changeTheme(intval($theme),$this->usersession['userid']);
	}
	public function logout(){
		$_SESSION['usersession']=null;
		unset($_SESSION['usersession']);
		$this->redirect('Login/index');
	}
	public function passwd(){
		$this->display('passwd');
	}
	public function dopasswd(){
		$old=$_POST['oldpwd'];
		$new=$_POST['newpwd'];
		$confirm=$_POST['confirmpwd'];
		if($confirm!=$new){
			echo json_encode(array('status'=>0,'msg'=>'新密码两次输入不一致'));
			exit;
		}
		$uid=intval($this->usersession['userid']);
		$res=$this->api->IndexIndex_passwd($uid,$old,$new);
		if(empty($res)) 
		exit(json_encode(array('status'=>0,'msg'=>'密码修改失败')));
		exit(json_encode(array('status'=>1,'msg'=>'密码修改成功')));
	}
}
?>