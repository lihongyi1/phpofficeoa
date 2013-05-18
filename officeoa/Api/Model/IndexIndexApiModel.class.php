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
	public function getdoucument(){
		$contents=$this->table(C('DB_PREFIX').'enotice')->where(array('isdelete'=>0,'type'=>3))->order('`date` desc')->limit(4)->select();
		return $contents;
	}
	public function getelectronic(){
		$contents=$this->table(C('DB_PREFIX').'enotice')->where(array('isdelete'=>0,'type'=>1))->order('`date` desc')->limit(4)->select();
		return $contents;
	}
	public function getinter(){
		$contents=$this->table(C('DB_PREFIX').'enotice')->where(array('isdelete'=>0,'type'=>2))->order('`date` desc')->limit(4)->select();
		return $contents;
	}
	public function passwd($uid,$old,$new){
		$res=$this->table(C('DB_PREFIX').'user')->where(array('userid'=>$uid,'passwd'=>md5($old),'isdelete'=>0))->save(array('passwd'=>md5($new)));
		return $res;
	}
	

}
?>
