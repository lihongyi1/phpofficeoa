<?php 
class IndexAction extends BaseAction{
	public function _initialize() {
	   		parent::base();
	}
	public function index(){
		
		$data=$this->api->FlowIndex_listflowtemplate();
		$this->assign('lists',$data);
		$this->display();
	}
	
	public function addflow(){
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
    	$this->assign('type',$_REQUEST['type']);
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
    		$html.='<td><a class="realname" href="'.__APP__.'/AddressList/userInfo/uid/'.intval($user['userid']).'">'.htmlspecialchars($user["realname"]).'</a></td>';
    		$html.='<td class="username">'.htmlspecialchars($user['username']).'</td>';
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
    
    public function doaddtemplate(){
    	$title=htmlspecialchars($_POST['title'],ENT_QUOTES);
    	$desc=htmlspecialchars($_POST['desc'],ENT_QUOTES);
    	$content=htmlspecialchars($_POST['content'],ENT_QUOTES);
    	$fqids=$_POST['fqids'];
    	$spids=$_POST['spids'];
    	$data['title']=$title;
    	$data['descb']=$desc;
    	$data['content']=$content;
    	$data['date']=date('Y-m-d H:i:s');
    	$data['fqids']=implode(',',$fqids);
    	$data['spids']=implode(',',$spids);
    	$id=$this->api->FlowIndex_addflowtemplate($data);
    	if(empty($id)){
    		echo 'error';
    		exit;
    	}else{
    		echo 'success';
    		exit;
    	}
    }
    public function deltemplate(){
    	$id=intval($_POST['id']);
    	$res=$this->api->FlowIndex_delflowtemplate($id);
    	if(empty($res)){
    		echo 'error';
    		exit;
    	}else{
    		echo 'success';
    		exit;
    	}
    }
}
?>