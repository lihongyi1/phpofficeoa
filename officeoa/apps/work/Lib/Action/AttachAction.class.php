<?php 
class AttachAction extends BaseAction{
	public function _initialize() {
	   		parent::base();
	}
	public function index(){
		$pagenow=intval($_GET['page']);
    	$pagenow=empty($pagenow)?1:$pagenow;
		$data=$this->api->WorkAttach_listAttaches($pagenow);
		$this->assign('resources',$data);
		$this->display();
	}
	public function addAttach(){
		$this->display('addAttach');
	}
	public function upload(){
		if(empty($_FILES)){
			$this->error('操作错误，请重试');
		}
		import('UploadFile');
		$upload=new UploadFile();
		$upload->savePath=SITE_PATH.'/data/resourse/';
		$upload->subType='date';
		$upload->maxSize=5*1024*1024;
		$upload->autoSub=true;
		$res=$upload->upload();
		if(empty($res)) exit('error');
		$info=$upload->getUploadFileInfo();
		$data['attachname']=strip_tags($info[0]['name']);
		$data['size']=$info[0]['size'];
		$data['content']=htmlspecialchars($_POST['content']);
		$data['path']=$info[0]['savepath'];
		$data['savename']=$info[0]['savename'];
		$data['ext']=$info[0]['extension'];
		$data['ctime']=date('Y-m-d H:i:s');
		$data['uid']=$this->usersession['userid'];
		$res=$this->api->WorkAttach_addAttach($data);
		if(empty($res)) exit('error');
		exit('success');
	}
	public function download(){
		$aid=intval($_GET['aid']);
		$res=$this->api->WorkAttach_getAttach($aid);
		if(empty($res)) $this->error('操作失败，请重试');
		$this->api->WorkAttach_addClick($aid);
		import('Http');
		Http::download($res['path'].$res['savename'],iconv('utf-8','gb2312//ignore',$res['attachname']));
	}
	
	public function delete(){
		$aid=intval($_GET['aid']);
		$res=$this->api->WorkAttach_delAttach($aid);
		if(empty($res)) $this->error('操作失败，请重试');
		$this->redirect('index');
	}
	
	public function detail(){
		$aid=intval($_GET['aid']);
		$res=$this->api->WorkAttach_getAttach($aid);
		$this->assign('data',$res);
		$this->display('detail');
	}
}
?>