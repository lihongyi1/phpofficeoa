<?php
class InfoAction extends BaseAction {
	public function _initialize() {
	   		parent::base();
	}
    public function index(){
    	$send=$this->api->InfoInfo_getsend($this->usersession['userid']);
    	$receive=$this->api->InfoInfo_getreceice($this->usersession['userid']);
    	$this->assign('sends',$send);
    	$this->assign('receives',$receive);
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
    
    
    /**
       * ++++++++++++++++++
       * @date: 2013-4-23
       * @author: lihongyi
       * @return:发送信息
       * 
       * ++++++++++++++++++
    */
    public function doSend(){
    	$info=htmlspecialchars($_POST['content']);
    	$ids=$_POST['ids'];
    	$data['content']=$info;
    	$data['fromid']=intval($this->usersession['userid']);
    	$data['ctime']=date('Y-m-d H:i:s');
    	foreach($ids as $id){
    		$data['toid']=intval($id);
    		$res=$this->api->InfoInfo_sendInfo($data);
    	}
    }
    
    
    /**
       * ++++++++++++++++++
       * @date: 2013-4-23
       * @author: lihongyi
       * @return:查看收消息
       * 
       * ++++++++++++++++++
    */
    public function viewinbox(){
    	$rid=intval($_GET['rid']);
    	$uid=intval($this->usersession['userid']);
    	$data=$this->api->InfoInfo_view($rid,$uid);
    	$this->assign('msgs',$data);
    	$this->assign('rid',$rid);
    	$this->display();
    }
    
 	public function viewoutbox(){
    	$rid=intval($_GET['rid']);
    	$uid=intval($this->usersession['userid']);
    	$data=$this->api->InfoInfo_view($rid,$uid);
    	$this->assign('msgs',$data);
    	$this->assign('rid',$rid);
    	$this->display();
    }
    
    public function setread(){
    	$id=intval($_POST['id']);
    	$res=$this->api->InfoInfo_setRead($id);
    	echo $res;
    }
    public function delete()
    {
    	$id=intval($_POST['id']);
    	$uid=intval($this->usersession['userid']);
    	$res=$this->api->InfoInfo_delete($id,$uid);
    	if(empty($res)){
    		echo 'error';
    	}else{
    		echo 'success';
    	}
    }

	public function reply(){
		$rid=intval($_POST['rid']);
		$uid=intval($this->usersession['userid']);
		$content=htmlspecialchars($_POST['content']);
		$res=$this->api->InfoInfo_reply($rid,$uid,$content);
		if(empty($res)){
			echo 'error';
		}else{
			echo 'success';
		}
		
	}   
    public function test(){
    	$send=$receive=$this->api->InfoInfo_getreceice($this->usersession['userid']);
    	dump($send);
    }
}