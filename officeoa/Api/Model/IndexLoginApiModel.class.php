<?
class IndexLoginApiModel extends Model{
	public function __construct(){
		$db_config=C('db_config');
		$this->db = Db::getInstance($db_config);
	}
	public function dologin($username){
			$res=$this->table(C('DB_PREFIX').'user')->where(array('username'=>$username))->find();
			return $res;
	}
	public function selectTheme($uid){
		$res=$this->table(C('DB_PREFIX').'theme')->field(array('theme,width'))->where(array('uid'=>$uid))->find();
		return $res;
	}
	
	

}
?>
