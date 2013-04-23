<?
class PersonalUserInfoApiModel extends Model{
	public function __construct(){
		$db_config=C('db_config');
		$this->db = Db::getInstance($db_config);
	}
	public function getUserInfo($userid){
		$user=$this->table(C('DB_PREFIX').'user')->where(array('userid'=>intval($userid)))->find();
		return $user;
	}
	public function getDeptName($did){
		$dept=$this->table(C('DB_PREFIX').'dept')->where(array('deptid'=>intval($did)))->find();
		return $dept;
	}
	public function getPositionName($pid){
		$position=$this->table(C('DB_PREFIX').'position')->where(array('positionid'=>intval($pid)))->find();
		return $position;
	}
	public function updateUser($userid,$data){
		$this->table(C('DB_PREFIX').'user')->where(array('userid'=>intval($userid)))->save($data);
	}
}
?>
