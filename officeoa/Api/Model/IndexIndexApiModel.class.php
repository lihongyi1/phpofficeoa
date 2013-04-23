<?
class IndexIndexApiModel extends Model{
	public function __construct(){
		$db_config=C('db_config');
		$this->db = Db::getInstance($db_config);
	}
	public function changeWidth($width,$userid){
		$res=$this->table(C('DB_PREFIX').'theme')->where(array('uid'=>$userid))->find();
		if(!empty($res)){
			$res=$this->table(C('DB_PREFIX').'theme')->where(array('uid'=>$userid))->save(array('width'=>$width));
		}else{
			$res=$this->table(C('DB_PREFIX').'theme')->add(array('width'=>$width,'uid'=>$userid));
		}
		return $res;
	}
	public function changeTheme($theme,$userid){
		$res=$this->table(C('DB_PREFIX').'theme')->where(array('uid'=>$userid))->find();
		if(!empty($res)){
			$res=$this->table(C('DB_PREFIX').'theme')->where(array('uid'=>$userid))->save(array('theme'=>$theme));
		}else{
			$res=$this->table(C('DB_PREFIX').'theme')->add(array('theme'=>$theme,'uid'=>$userid));
		}
		return $res;
	}
	
	

}
?>
