<?php

class LoginAction extends BaseAction {
   public function _initialize() {
   		parent::base();
   }
   public function index(){
		$this->display();
   }
   public function dologin(){
   		$username=trim($_POST['username']);
   		$passwd=trim($_POST['password']);
   		$res=$this->api->IndexLogin_dologin(addslashes($username));
   		if(empty($username) || empty($res)){
   			echo 'error';
   			exit;
   		}
   		if(empty($passwd) || $res['passwd']!= md5($passwd)){
   			echo 'error';
   			exit;
   		}
   		$usersession['user']=$res;
   		$_SESSION['usersession']=$usersession;
   		echo 'success';
   		
   }
}
