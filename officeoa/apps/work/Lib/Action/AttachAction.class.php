<?php 
class AttachAction extends BaseAction{
	public function _initialize() {
	   		parent::base();
	}
	public function index(){
		//dump($_SESSION['usersession']);
		$this->display();
	}
	public function addAttach(){
		$this->display('addAttach');
	}
	public function upload(){
		import('UploadFile');
		$upload=new UploadFile();
		$upload->savePath=SITE_PATH.'/data/resourse/';
		$upload->subType='date';
		$upload->autoSub=true;
		$res=$upload->upload();
		echo json_encode($upload->getUploadFileInfo()) ;
	}
}
?>