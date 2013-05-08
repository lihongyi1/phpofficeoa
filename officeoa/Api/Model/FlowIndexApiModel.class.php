<?
class FlowIndexApiModel extends Model{
	public function __construct(){
		$db_config=C('db_config');
		$this->db = Db::getInstance($db_config);
	}
	public function addflowtemplate($data){
		$res=$this->table(C('DB_PREFIX').'flow_template')->add($data);
		return $res;
	}
	
	public function editflowtemplate($lid){
		$data=$this->table(C('DB_PREFIX').'flow_template')->where(array('lid'=>intval($lid),'isdel'=>0))->find();
		$data['fqids']=explode(',',$data['fqids']);
		$data['spids']=explode(',',$data['spids']);
		foreach ($data['fqids'] as $key=>$value) {
			$data['fqinfo'][]=$this->table(C("DB_PREFIX").'user')->field('userid,realname')->where(array('userid'=>intval($value)))->find();
		}
		foreach ($data['spids'] as $key=>$value) {
			$data['spinfo'][]=$this->table(C("DB_PREFIX").'user')->field('userid,realname')->where(array('userid'=>intval($value)))->find();
		}
		return $data;
	}
	
	public function saveflowtemplate($lid,$data){
		$res=$this->table(C('DB_PREFIX').'flow_template')->where(array('lid'=>$lid))->save($data);
		return $res;
	}
	
	public function listflowtemplate(){
		$data=$this->table(C('DB_PREFIX').'flow_template')->field('lid,title,`descb`')->where(array('isdel'=>0))->select();
		return $data;
	}
	public function delflowtemplate($id){
		$res=$this->table(C('DB_PREFIX').'flow_template')->where(array('lid'=>$id))->save(array('isdel'=>1));
		return $res;
	}
		
	/**
	   * ++++++++++++++++++
	   * @date:2013-5-6 
	   * @author: lihongyi
	   * @describe: 检测是否具有申请权限。
	   * @return:
	   * 
	   * ++++++++++++++++++
	*/
	public function checkapply($lid,$uid){
		$res=$this->table(C('DB_PREFIX').'flow_template')->where(array('lid'=>$lid,'isdel'=>0))->find();
		if(empty($res)) return false;
		if(in_array($uid,explode(',',$res['fqids']))) return $res;
		return false;
	}
	
	public function doapply($lid,$uid,$arr,$title,$content){
		$date=date('Y-m-d H:i:s');
		$id=$this->table(C('DB_PREFIX').'flow_apply')->add(array('lid'=>$lid,'uid'=>$uid,'title'=>$title,'content'=>$content,'atime'=>$date,'atitle'=>$arr['title']));
		if(empty($id)) return false;
		$spids=explode(',',$arr['spids']);
		foreach ($spids as $key=>$spid) {
			$this->table(C('DB_PREFIX').'flow_reply')->add(array('aid'=>intval($id),'spid'=>intval($spid),'stime'=>$date));
		}
	}
	public function myapplylist($uid){
		$data=$this->table(C('DB_PREFIX').'flow_apply')->where(array('uid'=>$uid))->select();
		foreach ($data as $key=>$value) {
			switch ($value['status']) {
				case 0:
				$data[$key]['status']='审批中';
				break;
				case 1:
				$data[$key]['status']='通过';
				break;
				case 2:
				$data[$key]['status']='驳回';
				break;
				case 3:
				$data[$key]['status']='撤销';
				break;
			}
		}
		return $data;
	}
	
	
	

}
?>
