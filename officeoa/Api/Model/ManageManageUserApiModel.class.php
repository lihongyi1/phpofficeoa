<?
class ManageManageUserApiModel extends Model{
	public function __construct(){
		$db_config=C('db_config');
		$this->db = Db::getInstance($db_config);
	}
	public function updateUser($data){
		$re=$this->table(C('DB_PREFIX').'user')->where(array('userid'=>$data['userid']))->find();
		$res=$this->table(C('DB_PREFIX').'user')->where(array('userid'=>$data['userid']))->save($data);
		if(empty($res)) return 'error';
		$res=$this->table(C('DB_PREFIX').'dept')->where(array('deptid'=>$re['deptid']))->setDec('deptnum');
		$res=$this->table(C('DB_PREFIX').'position')->where(array('positionid'=>$re['positionid']))->setDec('positionnum');
		$res=$this->table(C('DB_PREFIX').'dept')->where(array('deptid'=>$data['deptid']))->setInc('deptnum');
		$res=$this->table(C('DB_PREFIX').'position')->where(array('positionid'=>$data['positionid']))->setInc('positionnum');
		return $res;
	}
	public function deleteUser($uid){
		$res=$this->table(C('DB_PREFIX').'user')->where(array('userid'=>intval($uid),'role'=>array('neq',1),'isdelete'=>0))->save(array('isdelete'=>1));
		return $res;
	}
	public function getPosition($deptid){
		$where=empty($deptid)?"":array('deptid'=>$deptid);
		$res=$this->table(C('DB_PREFIX').'position')->field(array('positionid','position'))->where($where)->select();
		return $res;
	}
	
	public function addUser($data){
			$res=$this->table(C('DB_PREFIX').'user')->add($data);
			if(empty($res)) return 'error';
			$res=$this->table(C('DB_PREFIX').'dept')->where(array('deptid'=>$data['deptid']))->setInc('deptnum');
			$res=$this->table(C('DB_PREFIX').'position')->where(array('positionid'=>$data['positionid']))->setInc('positionnum');
			return $res;
			
	}

}
?>
