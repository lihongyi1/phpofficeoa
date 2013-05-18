<?php
class DocumentInfoAction extends BaseAction {
	public function _initialize() {
	   		parent::base();
	}
    public function index(){
    	$pagenow=intval($_GET['page']);
    	$pagenow=empty($pagenow)?1:$pagenow;
    	$res=$this->api->InfoDocumentInfo_allDocumentInfos($pagenow);
    	$this->assign('info',$res);
    	$this->display();
    }
	
    public function addInfo(){
    	$this->display('addinfo');
    }
    public function doAddInfo(){
    	$title=htmlspecialchars($_POST['title'],ENT_QUOTES);
    	$content=htmlspecialchars($_POST['content'],ENT_QUOTES);
    	$data['title']=$title;
    	$data['content']=$content;
    	$data['uid']=$this->usersession['userid'];
    	$data['date']=date('Y-m-d H:i:s');
    	$res=$this->api->InfoDocumentInfo_addDocumentInfo($data);
    	echo $res;
    }
    
    /**
    　 *++++++++++++++++++++
    　 * @date: 2013-4-16
    　 * @author: lihongyi
    　 * @return: 弹层查看电子公文
    *++++++++++++++++++
    */
    public function look(){
    	$eid=intval($_GET['eid']);
    	$info=$this->api->InfoDocumentInfo_getDocumentInfo($eid);
    	$this->assign('info',$info);
    	$this->display('look');
    }
    
    
    /**
       * ++++++++++++++++++
       * @date: 2013-4-17
       * @author: lihongyi
       * @return:正常查看电子公文
       * 
       * ++++++++++++++++++
    */
    public function lookup(){
    	$eid=intval($_GET['eid']);
    	$info=$this->api->InfoDocumentInfo_getDocumentInfo($eid);
    	$this->assign('info',$info);
    	$this->display('look1');
    }
  
    /**
       * ++++++++++++++++++
       * @date: 2013-4-16
       * @author: lihongyi
       * @return:显示编辑电子公文
       * 
       * ++++++++++++++++++
    */
    public function edit(){
    	$eid=intval($_GET['eid']);
    	$info=$this->api->InfoDocumentInfo_getDocumentInfo($eid);
    	$this->assign('info',$info);
    	$this->display('edit');
    	
    }
    
    /**
       * ++++++++++++++++++
       * @date: 2013-4-17
       * @author: lihongyi
       * @return:编辑电子公告
       * 
       * ++++++++++++++++++
    */
    public function doedit(){
    	$eid=intval($_POST['eid']);
    	$content=htmlspecialchars($_POST['content']);
    	$title=htmlspecialchars($_POST['title']);
    	$data['title']=$title;
    	$data['content']=$content;
    	$data['uid']=$this->usersession['userid'];
    	$data['date']=date('Y-m-d H:i:s');
    	$res=$this->api->InfoDocumentInfo_editDocumentInfo($eid,$data);
    	if(empty($res))
    	echo 'error';
    }
    
    public function delete(){
    	$eid=intval($_POST['eid']);
    	$res=$this->api->InfoDocumentInfo_delDocumentInfo($eid);
    	if(empty($res)){
    		echo 'error';
    	}else{
    		echo 'success';
    	}
    }
    
    /**
       * ++++++++++++++++++
       * @date: 2013-4-17
       * @author: lihongyi
       * @return:批量删除电子公告
       * 
       * ++++++++++++++++++
    */
    public function deleteAll(){
    	$ids=$_POST['ids'];
    	if(is_array($ids)&& count($ids)>0){
    		foreach ($ids as $key=>$id) {
    			$ids[$key]=intval($id);
    		}
    	$res=$this->api->InfoDocumentInfo_delDocumentInfos($ids);
    	echo $res;
    	}else{
    		echo 'error';
    		exit;
    	}
    	
    	
    }
    
    /**
       * ++++++++++++++++++
       * @date: 2013-4-17
       * @author: lihongyi
       * @return: 搜索电子公告
       * 
       * ++++++++++++++++++
    */
    public function search(){
    	$keyword=addslashes(trim($_GET['keyword']));
    	$page=intval($_GET['page']);
    	$res=$this->api->InfoDocumentInfo_searchInfo($keyword,$page);
    	$this->assign('keyword',$keyword);
    	$this->assign('info',$res);
    	$this->display('index');
    }
    
    public function test(){
    	$keyword='封';
    	$res=$this->api->InfoDocumentInfo_searchInfo($keyword);
    }
}