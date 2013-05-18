<?
class InfoInfoApiModel extends Model{
	public function __construct(){
		$db_config=C('db_config');
		$this->db = Db::getInstance($db_config);
	}
	
	/**
	   * ++++++++++++++++++
	   * @date: 2013-4-23
	   * @author: lihongyi
	   * @return:发送信息
	   * 
	   * ++++++++++++++++++
	*/
	public function sendInfo($data){
		$res=$this->table(C('DB_PREFIX').'info')->add($data);
		return $res;
	}
	
	
	/**
	   * ++++++++++++++++++
	   * @date: 2013-4-23
	   * @author: lihongyi
	   * @return:发件箱列表
	   * 
	   * ++++++++++++++++++
	*/
	public function getsend($uid){
		$condition='fromid='.$uid.' and isnew=1 and isdelete!='.$uid;
		$data=$this->table(C('DB_PREFIX').'info')->where($condition)->order('ctime desc')->select();
		foreach ($data as $key=>$value) {
			if(empty($value['replyid'])) $data[$key]['replyid']=$value['id'];
			$data[$key]['toid']=$this->table(C('DB_PREFIX').'user')->field(array('userid','realname'))->where(array('userid'=>$value['toid']))->find();
		}
		return $data;
	}
	
	/**
	   * ++++++++++++++++++
	   * @date: 2013-4-24
	   * @author: lihongyi
	   * @return:收件箱列表
	   * 
	   * ++++++++++++++++++
	*/
	public function getreceice($uid){
		$condition='toid ='.$uid.' and isnew=1 and isdelete!='.$uid;
		$data=$this->table(C('DB_PREFIX').'info')->where($condition)->order('isread,ctime desc')->select();
		foreach ($data as $key=>$value) {
			if(empty($value['replyid'])) $data[$key]['replyid']=$value['id'];
			$data[$key]['fromid']=$this->table(C('DB_PREFIX').'user')->field(array('userid','realname'))->where(array('userid'=>$value['fromid']))->find();
		}
		return $data;
	}
	
	/**
	   * ++++++++++++++++++
	   * @date:2013-4-25 
	   * @author: lihongyi
	   * @describe:设置为已读消息 
	   * @param:
	   * @return:
	   * 
	   * ++++++++++++++++++
	*/	 
	public function setRead($id){
		$res=$this->table(C("DB_PREFIX").'info')->where(array('id'=>$id))->save(array('isread'=>1));
		return $res;
	}
		
	/**
	   * ++++++++++++++++++
	   * @date:2013-4-25 
	   * @author: lihongyi
	   * @describe: 查看消息
	   * @param:
	   * @return:
	   * 
	   * ++++++++++++++++++
	*/
	public function view($replyid,$uid){
		
		$condition='(replyid='.$replyid.' or id='.$replyid.')';
		$data=$this->table(C('DB_PREFIX').'info')->where($condition)->order("ctime")->select();
		foreach ($data as $key=>$value) {
			$data[$key]['fromid']=$this->table(C('DB_PREFIX').'user')->field(array('userid','realname'))->where(array('userid'=>$value['fromid']))->find();
			$data[$key]['toid']=$this->table(C('DB_PREFIX').'user')->field(array('userid','realname'))->where(array('userid'=>$value['toid']))->find();
		}
		return $data;
	}
	
		
	/**
	   * ++++++++++++++++++
	   * @date:2013-5-1 
	   * @author: lihongyi
	   * @describe: 删除消息
	   * @param:
	   * @return:
	   * 
	   * ++++++++++++++++++
	*/
	public function delete($id,$uid){
		$where=array('id'=>$id);
		$data=$this->table(C('DB_PREFIX').'info')->where($where)->save(array('isdelete'=>$uid));
		return $data;
	}
		
	public function reply($rid,$uid,$content){
		$data=$this->table(C('DB_PREFIX').'info')->where(array('id'=>$rid))->find();
		$data1['content']=$content;
		$data1['fromid']=$uid;
		$data1['toid']=$data['fromid']==$uid?$data['toid']:$data['fromid'];
		$data1['replyid']=$rid;
		$data1['ctime']=date('Y-m-d H:i:s');
		$condition='(fromid='.$uid.') and (replyid='.$rid.' or id='.$rid.') and isnew=1';
		$res=$this->table(C('DB_PREFIX').'info')->where($condition)->save(array('isnew'=>0));
		$res=$this->table(C('DB_PREFIX').'info')->add($data1);
		return $res;
	}
	public function getcount($uid){
		$condition='toid ='.$uid.' and isnew=1 and isread=0 and isdelete!='.$uid;
		$data=$this->table(C('DB_PREFIX').'info')->where($condition)->count();
		return $data;
	}
	

}
?>
