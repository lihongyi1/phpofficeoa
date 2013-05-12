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
		$id=$this->table(C('DB_PREFIX').'flow_apply')->add(array('lid'=>$lid,'uid'=>$uid,'title'=>$title,'content'=>$content,'spids'=>$arr['spids'],'atime'=>$date,'atitle'=>$arr['title']));
		if(empty($id)) return false;
		$spids=explode(',',$arr['spids']);
		foreach ($spids as $key=>$spid) {
			$this->table(C('DB_PREFIX').'flow_reply')->add(array('aid'=>intval($id),'spid'=>intval($spid),'step'=>$key,'stime'=>$date));
		}
	}
	public function myapplylist($uid){
		$data=$this->table(C('DB_PREFIX').'flow_apply')->where(array('uid'=>$uid,'isdel'=>0))->select();
		foreach ($data as $key=>$value) {
			switch ($value['status']) {
				case 0:
				$data[$key]['status']='未批复';
				break;
				case 1:
				$data[$key]['status']='正在批复';
				break;
				case 2:
				$data[$key]['status']='通过';
				break;
				case 3:
				$data[$key]['status']='驳回';
				break;
				case 4:
				$data[$key]['status']='撤销';
				break;
			}
		}
		return $data;
	}
	
	public function myreplylist($uid){
		$data=$this->table(C('DB_PREFIX').'flow_reply  as r left join '.C('DB_PREFIX').'flow_apply as a on r.aid=a.id ')
				->field('r.rid,r.aid,r.spid,r.content,r.status,a.atime,a.atitle,a.title')
				->where('spid='.$uid.' and a.status!=4 and r.step<=a.step')
				->select();
		foreach ($data as $key=>$value) {
			
			switch ($value['status']) {
				case 0:
				$data[$key]['status']='未批复';
				break;
				case 1:
				$data[$key]['status']='通过';
				break;
				case 2:
				$data[$key]['status']='驳回';
				break;
			}
		}
		return $data;
	}
	
	public function getmyapply($aid,$uid){
		$data=$this->table(C('DB_PREFIX').'flow_apply')
			->where(array('uid'=>$uid ,'id'=>$aid,'isdel'=>0))
			->find();
		if(empty($data)) return false;
		return $data;
		
	}
	public function getspusers($aid){
		$data=$this->table(C('DB_PREFIX').'flow_reply')
			->where(array('aid'=>$aid))
			->order('step')
			->select();
		foreach ($data as $key=>$value) {
			$data[$key]['spid']=$this->table(C("DB_PREFIX").'user')->field('userid,realname')->where(array('userid'=>intval($value['spid'])))->find();
			switch ($value['status']) {
					case 0:
					$data[$key]['statusinfo']='未批复';
					break;
					case 1:
					$data[$key]['statusinfo']='通过';
					break;
					case 2:
					$data[$key]['statusinfo']='驳回';
					break;
				}
		}
		return $data;
	}
	
	public function undoapply($id,$uid){
		$res=$this->table(C('DB_PREFIX').'flow_apply')
			->where(array('id'=>intval($id),'uid'=>$uid,'status'=>0,'isdel'=>0))
			->save(array('status'=>4,'laststatus'=>1,'utime'=>date('Y-m-d H:i:s')));
		return $res;
	}
	
	public function getmyreply($rid,$uid){
		$data=$this->table(C('DB_PREFIX').'flow_reply  as r left join '.C('DB_PREFIX').'flow_apply as a on r.aid=a.id ')
				->field('r.rid,r.aid,r.spid,r.status,a.laststatus,a.atime,a.utime,a.content,a.title,a.atitle')
				->where('rid='.$rid.' and spid='.$uid)
				->find();
		return $data;
	}
	
	public function doreply($uid,$rid,$re,$content){
		$res=$this->table(C('DB_PREFIX').'flow_reply')
			->where(array('rid'=>intval($rid),'spid'=>intval($uid)))
			->save(array('status'=>$re,'content'=>$content,'stime'=>date('Y-m-d H:i:s')));
		if(empty($res)) return false;
		$step=$this->table(C('DB_PREFIX').'flow_reply')
			->field('step,aid')
			->where(array('rid'=>intval($rid),'spid'=>intval($uid)))
			->find();
		if($re==2){
			$res=$this->table(C('DB_PREFIX').'flow_apply')
				->where(array('id'=>intval($step['aid']),'isdel'=>0))
				->save(array('laststatus'=>1,'status'=>3,'utime'=>date('Y-m-d H:i:s')));
			return $res;
		}
		if(empty($step)) return false;
		$last=$this->table(C('DB_PREFIX').'flow_apply')
			->field('spids')
			->where(array('id'=>intval($step['aid']),'isdel'=>0))
			->find();
		if(empty($last)) return false;
		$last=count(explode(',',$last['spids']));
		if(intval($step['step'])<intval($last)-1){
		$res=$this->table(C('DB_PREFIX').'flow_apply')
			->where(array('id'=>intval($step['aid']),'isdel'=>0))
			->save(array('status'=>1,'laststatus'=>0,'utime'=>date('Y-m-d H:i:s')));
		$res=$this->table(C('DB_PREFIX').'flow_apply')
			->where(array('id'=>intval($step['aid']),'isdel'=>0))
			->setInc('step');
		return $res;
		}else{
			$res=$this->table(C('DB_PREFIX').'flow_apply')
			->where(array('id'=>intval($step['aid']),'isdel'=>0))
			->save(array('laststatus'=>1,'status'=>2,'utime'=>date('Y-m-d H:i:s')));
			return $res;
		}
	}

	
	
	

}
?>
