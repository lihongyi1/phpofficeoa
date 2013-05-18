<?php

class LoginAction extends Action {
   public function index(){
   		$Themes=C('THEME');
		$Widths=C('WIDTH');
		$this->assign('theme',$Themes[0]);
		$this->assign('width',$Widths[0]);
		$this->display();
   }
   public function dologin(){
   		$username=trim($_POST['username']);
   		$passwd=trim($_POST['password']);
   		$res=$this->api->IndexLogin_dologin(addslashes($username));
   		if(empty($username) || empty($res) || $res['username']!=$username){
   			echo 'error';
   			exit;
   		}
   		if(empty($passwd) || $res['passwd']!= md5($passwd)){
   			echo 'error';
   			exit;
   		}
   		$usersession['user']=$res;
   		$usersession['lasttime']=time();
   		$_SESSION['usersession']=$usersession;
   		echo 'success';
   		
   }
}
