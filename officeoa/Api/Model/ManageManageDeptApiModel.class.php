<?
class ManageManageDeptApiModel extends Model{
	public function __construct(){
		$db_config=C('db_config');
		$this->db = Db::getInstance($db_config);
	}
	public function getPosition($deptid){
		$where=array('deptid'=>$deptid);
		$res=$this->table(C('DB_PREFIX').'position')->field(array('positionid','position'))->where($where)->select();
		return $res;
	}
	public function addDept($dept){
		$deptid=$this->table(C('DB_PREFIX').'dept')->add(array('deptname'=>$dept));
		return $deptid;
	}
	public function addPosition($deptid,$position){
		$positionid=$this->table(C('DB_PREFIX').'position')->add(array('position'=>$position,'deptid'=>intval($deptid)));
		return $positionid;
	}
	public function delDept($deptid){
		$res=$this->table(C('DB_PREFIX').'dept')->where(array('deptid'=>intval($deptid),'deptnum'=>array('eq','0')))->delete();
		return $res;
	}
	public function delPosition($pid){
		$res=$this->table(C('DB_PREFIX').'position')->where(array('positionid'=>intval($pid),'positionnum'=>array('eq','0')))->delete();
		return $res;
	}

	public function renameDept($did,$dept){
		$res=$this->table(C('DB_PREFIX').'dept')->where(array('deptid'=>intval($did)))->save(array('deptname'=>$dept));
		return $res;
	}
	public function renamePosition($pid,$position){
		$res=$this->table(C('DB_PREFIX').'position')->where(array('positionid'=>intval($pid)))->save(array('position'=>$position));
		return $res;
	}
}
?>
