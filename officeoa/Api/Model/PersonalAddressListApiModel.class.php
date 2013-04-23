<?
class PersonalAddressListApiModel extends Model{
	public function __construct(){
		$db_config=C('db_config');
		$this->db = Db::getInstance($db_config);
	}
	public function getAllDepts(){
		$res=$this->table(C('DB_PREFIX').'dept')->field(array('deptid','deptname'))->select();
		return $res;
	}
	public function getAllUsers($info=""){
		$where=empty($info)? "":"realname like '".$info."%'";
		$res=$this->table(C('DB_PREFIX').'user')->field(array('userid','username','realname','mobile','deptid','positionid','tel','email'))->where($where)->select();
		return $res;
	}
	public function getUsersByDept($dept){
		
		$where=empty($dept)?"":array('deptid'=>$dept);
		$res=$this->table(C('DB_PREFIX').'user')->field(array('userid','username','realname','mobile','deptid','positionid','tel','email'))->where($where)->select();
		return $res;
	}
	
	

}
?>
