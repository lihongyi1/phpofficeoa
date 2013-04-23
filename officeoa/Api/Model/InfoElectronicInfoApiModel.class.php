<?
class InfoElectronicInfoApiModel extends Model{
	public function __construct(){
		$db_config=C('db_config');
		$this->db = Db::getInstance($db_config);
	}
	public function addElectronicInfo($data){
		$data['type']=1;
		$res=$this->table(C('DB_PREFIX').'enotice')->add($data);
		return $res;
	}
	
	
	public function allElectronicInfos($pagenow=1){
		$pagenowcount=intval(C('PAGE')); //每页显示的页数
		$contents=$this->table(C('DB_PREFIX').'enotice')->where(array('isdelete'=>0,'type'=>1))->order('`date` desc')->page($pagenow.','.$pagenowcount)->select();
		foreach ($contents as $key=>$content) {
			$contents[$key]['uid']=$this->table(C('DB_PREFIX').'user')->field(array('userid','realname'))->where(array('userid'=>$content['uid']))->find();
		}
		$res['content']=$contents;
		$count=$this->table(C('DB_PREFIX').'enotice')->where(array('isdelete'=>0,'type'=>1))->count();
		import('Page');
		$page=new Page($count,$pagenowcount);
		$page->setConfig('first','首页');
		$page->setConfig('last','尾页');
		$page->setConfig('theme', '<ul class="pagination right nomargin"> <li>当前第%nowPage%页 共%totalPage%页 </li>%first%  %upPage% %linkPage%  %downPage% %end% </ul>');
		$res['page']=$page->show();
		
		return $res;
	}
	public function getElectronicInfo($eid){
		$eid=intval($eid);
		$data=$this->table(C('DB_PREFIX').'enotice')->where(array('eid'=>$eid,'isdelete'=>0,'type'=>1))->find();
		$this->table(C('DB_PREFIX').'enotice')->where(array('eid'=>$eid,'isdelete'=>0,'type'=>1))->setInc('click'); //增加点击率
		return $data;
	}
	
	
	/**
	   * ++++++++++++++++++
	   * @date: 2013-4-16
	   * @author: lihongyi
	   * @return:删除电子公文
	   * 
	   * ++++++++++++++++++
	*/
	public function delElectronicInfo($eid){
		$eid=intval($eid);
		$data=$this->table(C('DB_PREFIX').'enotice')->where(array('eid'=>$eid,'type'=>1))->save(array('isdelete'=>1));
		return $data;
	}
	
	/**
	   * ++++++++++++++++++
	   * @date: 2013-4-17
	   * @author: lihongyi
	   * @return:批量删除电子公告
	   * 
	   * ++++++++++++++++++
	*/
	public function delElectronicInfos($ids){
		$where['eid']=array('in',$ids);
		$where['type']=1;
		$data=$this->table(C('DB_PREFIX').'enotice')->where($where)->save(array('isdelete'=>1));
		return $data;
	}
	
	/**
	   * ++++++++++++++++++
	   * @date: 2013-4-17
	   * @author: lihongyi
	   * @return:根据id修改电子公告
	   * 
	   * ++++++++++++++++++
	*/
	public function editElectronicInfo($eid,$data){
		$res=$this->table(C('DB_PREFIX').'enotice')->where(array('eid'=>$eid,'type'=>1))->save($data);
		return $res;
	}
	
	public function queryLikeUser($keyword){
		$res=$this->table(C('DB_PREFIX').'user')->field(array('userid','realname'))->where(array('realname'=>array('like',$keyword.'%')))->select();
		return $res;
	}
	
	public function searchInfo($keyword,$pagenow=1){
		if(empty($keyword)){
			$res=$this->allElectronicInfos();
		}else{
			$pagenow=empty($pagenow)? 1:$pagenow;
			$pagenowcount=intval(C('PAGE')); //每页显示的页数
			$offset=$pagenowcount*($pagenow-1);
			$contents=$this->query("SELECT e.*,u.realname FROM oa_enotice AS e LEFT JOIN oa_user AS u ON e.uid=u.userid WHERE ( e.title LIKE '%".$keyword."%' ) AND ( e.isdelete = 0 )AND ( e.type = 1 ) OR (u.realname LIKE '".$keyword."%')");
			$count=count($contents);
			foreach ($contents as $key=>$content) {
				if($key>=$offset && $key<($offset+$pagenowcount)){
					$contents[$key]['uid']=$this->table(C('DB_PREFIX').'user')->field(array('userid','realname'))->where(array('userid'=>$content['uid']))->find();
					
				}else{
					unset($contents[$key]);
				}
			}
			$res['content']=$contents;
			import('Page');
			$page=new Page($count,$pagenowcount);
			$page->setConfig('first','首页');
			$page->setConfig('last','尾页');
			$page->setConfig('theme', '<ul class="pagination right nomargin"> <li>当前第%nowPage%页 共%totalPage%页 </li>%first%  %upPage% %linkPage%  %downPage% %end% </ul>');
			$res['page']=$page->show();
		}
			return $res;
	}
	
	
}
?>
