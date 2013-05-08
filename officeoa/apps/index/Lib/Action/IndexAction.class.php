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
}
?>