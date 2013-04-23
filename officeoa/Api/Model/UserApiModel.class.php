<?
class UserApiModel extends Model{
	public function __construct(){
		$db_config=C('db_config');
		$this->db = Db::getInstance($db_config);
	}
	public function test(){
		return 'hello world';	
	}
	public function test1(){
		$res=$this->table(C('DB_PREFIX').'test')->select();
		return $res;
	}
	public function test2($t){
		$res=$this->table(C('DB_PREFIX').'test')->where(array('tid'=>2))->save(array('no'=>$t));
		return $res;
	}

}
?>
