<?
class WorkAttachApiModel extends Model{
	public function __construct(){
		$db_config=C('db_config');
		$this->db = Db::getInstance($db_config);
	}
	public function addAttach($data){
		$res=$this->table(C('DB_PREFIX').'attach')->add($data);
		return $res;
	}
	public function listAttaches($pagenow=1){
		$pagenowcount=intval(C('PAGE')); //每页显示的页数
		$data[]=$this->table(C('DB_PREFIX').'attach')
		->field('aid,attachname,content')
		->where(array('isdel'=>0))
		->order('ctime desc')
		->page($pagenow.','.$pagenowcount)
		->select();
		$count=$this->table(C('DB_PREFIX').'attach')
		->field('aid,attachname,content')
		->where(array('isdel'=>0))->count();
		import('Page');
		$page=new Page($count,$pagenowcount);
		$page->setConfig('first','首页');
		$page->setConfig('last','尾页');
		$page->setConfig('theme', '<ul class="pagination right nomargin"> <li>当前第%nowPage%页 共%totalPage%页 </li>%first%  %upPage% %linkPage%  %downPage% %end% </ul>');
		$data['page']=$page->show();
		return $data;
	}
	public function getAttach($id){
		$res=$this->table(C('DB_PREFIX').'attach')->where(array('aid'=>intval($id),'isdel'=>0))->find();
		$res['uid']=$this->table(C('DB_PREFIX').'user')->field('userid,realname')->where(array('userid'=>intval($res['uid'])))->find();
		return $res;
	}
	public function delAttach($aid){
		$res=$this->table(C('DB_PREFIX').'attach')->where(array('aid'=>$aid,'isdel'=>0))->save(array('isdel'=>1));
		return $res;
	}
	
	public function addClick($aid){
		$res=$this->table(C('DB_PREFIX').'attach')->where(array('aid'=>$aid,'isdel'=>0))->setInc('click');
		return $res;
		
	}

}
?>
