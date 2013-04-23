<?php
class InfoAction extends BaseAction {
	public function _initialize() {
	   		parent::base();
	}
    public function index(){
    	$this->display();
    }
    public function add(){
    	$this->display();
    }
    public function users(){
    	$depts=$this->api->PersonalAddressList_getAllDepts();
    	$users=$this->api->PersonalAddressList_getAllUsers();
    	foreach ($users as $key=>$user) {
    		$user['deptname']=$this->api->PersonalUserInfo_getDeptName($user['deptid']);
    		$user['position']=$this->api->PersonalUserInfo_getPositionName($user['positionid']);
    		$users[$key]=$user;
    	}
    	$ids=explode(",",trim($_REQUEST['ids'],','));
    	$this->assign('ids',$ids);
    	$this->assign('depts',$depts);
    	$this->assign('users',$users);
    	$this->display('users');
    }
    
 public function search(){
    	$search=trim($_POST['info']);
    	$ids=$_POST['ids'];
    	$users=$this->api->PersonalAddressList_getAllUsers(addslashes($search));
    	$html="";
    	foreach ($users as $key=>$user) {
    		$user['deptname']=$this->api->PersonalUserInfo_getDeptName($user['deptid']);
    		$user['position']=$this->api->PersonalUserInfo_getPositionName($user['positionid']);
    		$html.='<tr>';
    		$html.='<td class="checkers"><input type="checkbox" class="checkOne"';
    		$html.=in_array(intval($user['userid']),$ids)?' checked="checked" ':" ";
    		$html.='id="'.intval($user['userid']).'"/></td>';
    		$html.='<td>'.htmlspecialchars($user["deptname"]['deptname']).'</td>';
    		$html.='<td><a href="'.__APP__.'/AddressList/userInfo/uid/'.intval($user['userid']).'">'.htmlspecialchars($user["realname"]).'</a></td>';
    		$html.='<td>'.htmlspecialchars($user['username']).'</td>';
    		$html.='<td>'.htmlspecialchars($user["position"]['position']).'</td>';
    		$html.='</tr>';
    	}
    	if(empty($html)){
    		$html='<tr><td colspan="5" ><a>没有符合条件的搜索结果。</a></td></tr>';
    	}
    	echo $html;
    }
    public function searchbyDept(){
    	$dept=intval(trim($_POST['dept']));
    	$ids=$_POST['ids'];
    	$users=$this->api->PersonalAddressList_getUsersByDept($dept);
    	$html="";
    	foreach ($users as $key=>$user) {
    		$user['deptname']=$this->api->PersonalUserInfo_getDeptName($user['deptid']);
    		$user['position']=$this->api->PersonalUserInfo_getPositionName($user['positionid']);
    		$html.='<tr>';
    		$html.='<td class="checkers"><input type="checkbox" class="checkOne"';
    		$html.=in_array(intval($user['userid']),$ids)?' checked="checked" ':" ";
    		$html.='id="'.intval($user['userid']).'"/></td>';
    		$html.='<td>'.htmlspecialchars($user["deptname"]['deptname']).'</td>';
    		$html.='<td><a class="realname" href="'.__APP__.'/AddressList/userInfo/uid/'.intval($user['userid']).'">'.htmlspecialchars($user["realname"]).'</a></td>';
    		$html.='<td class="username">'.htmlspecialchars($user['username']).'</td>';
    		$html.='<td>'.htmlspecialchars($user["position"]['position']).'</td>';
    		$html.='</tr>';
    	}
    	if(empty($html)){
    		$html='<tr><td colspan="5" align="center"><a>没有符合条件的搜索结果。</a></td></tr>';
    	}
    	echo $html;
    }
}