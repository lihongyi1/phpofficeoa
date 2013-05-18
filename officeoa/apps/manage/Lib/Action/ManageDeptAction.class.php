<?php 
class ManageDeptAction extends BaseAction{
	public function _initialize() {
	   		parent::base();
	}
	public function index(){
		
		$this->display('index');
	}
	public function getDepts(){
		$did=intval($_REQUEST['deptid']);
		$type=htmlspecialchars($_REQUEST['type']);
		if(empty($did)){
			$res=$this->api->PersonalAddressList_getAllDepts();
			if(empty($res)) exit;
			$da=null;
			foreach ($res as $dept) {
				$data['data']=$dept['deptname'];
				$data['attr']=array('id'=>'d_'.$dept['deptid'],'rel'=>'folder');
				$pts=$this->api->ManageManageDept_getPosition($dept['deptid']);
				foreach ($pts as $position) {
					$data1['data']=$position['position'];
					$data1['attr']=array('id'=>'p_'.$position['positionid'],'rel'=>'file');
					$data['children'][]=$data1;
				}
				$da[]=$data;
				unset($data);
			}
			if(empty($da)) exit;
			$result['data']='部门及职务';
			$result['attr']=array('id'=>'0_0','rel'=>'drive');
			$result['children']=$da;
			echo json_encode($result);
			exit;
		}
	}
	public function addDept(){
		$deptid=intval($_REQUEST['deptid']);
		$val=htmlspecialchars($_REQUEST['val']);
		if(empty($deptid)){
			//添加部门
			$res=$this->api->ManageManageDept_addDept($val);
			if(empty($res)) exit(json_encode(array('status'=>0)));
			exit(json_encode(array('status'=>1,'did'=>$res)));
		}else{
			//添加职务
			$res=$this->api->ManageManageDept_addPosition($deptid,$val);
			if(empty($res)) exit(json_encode(array('status'=>0)));
			exit(json_encode(array('status'=>1,'pid'=>$res)));
		}
	}
	public function delDept(){
		$type=intval($_REQUEST['type']);
		$id=intval($_REQUEST['id']);
		if($type==1){
			//删除部门
			$res=$this->api->ManageManageDept_delDept($id);
			if(empty($res)) 
			exit(json_encode(array('status'=>0,'error'=>'部门下存在员工，或操作失败')));
			exit(json_encode(array('status'=>1)));
		}elseif ($type==2){
			//删除职务
			$res=$this->api->ManageManageDept_delPosition($id);
			if(empty($res)) 
			exit(json_encode(array('status'=>0,'error'=>'职务下存在员工，或操作失败')));
			exit(json_encode(array('status'=>1)));
		}else{
			echo json_encode(array('status'=>0,'error'=>'操作失败'));
			exit;
		}
	}
	public function renameDept(){
		$type=intval($_REQUEST['type']);
		$id=intval($_REQUEST['id']);
		$val=htmlspecialchars($_REQUEST['val']);
		if($type==1){
			//修改部门名
			$res=$this->api->ManageManageDept_renameDept($id,$val);
			if(empty($res)) 
			exit(json_encode(array('status'=>0,'error'=>'修改部门失败，请重试')));
			exit(json_encode(array('status'=>1)));
		}elseif ($type==2){
			//修改职务名
			$res=$this->api->ManageManageDept_renamePosition($id,$val);
			if(empty($res)) 
			exit(json_encode(array('status'=>0,'error'=>'修改职务失败，请重试')));
			exit(json_encode(array('status'=>1)));
		}
	}
}
?>