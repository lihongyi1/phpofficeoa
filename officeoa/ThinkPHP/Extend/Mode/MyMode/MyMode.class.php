<?php 
class MyMode extends Action{
		
	public $usersession;
	
	public function start(){
		$this->Int(); 
		$this->sA();
		$this->stheme();
	}
	public function sA(){
		$this->usersession=$_SESSION['usersession']['user'];
		$this->assign('usersession',$this->usersession);
		$countmsg=$this->api->InfoInfo_getcount($this->usersession['userid']);
		$this->assign('countmsg',$countmsg);
	}
	
	public function Int(){
		if(empty($_SESSION['usersession']['user'])){
			$this->assign('jumpUrl',SITE_URL);
			$this->success('您好没有登录，请登录');
			exit;
		}
		if(isset($_SESSION['usersession']['lasttime'])){
			$lasttime=$_SESSION['usersession']['lasttime'];
			if((time()-$lasttime)>3600){
			Session(null);
			$this->assign('jumpUrl',SITE_URL);
			$this->success('您已安全退出，请重新登录');
			exit;
			}else{
				$_SESSION['usersession']['lasttime']=time();
			}
		}
	}
	
	/**
	 * @lihongyi
	 * 选择浏览主题
	 */
	public function stheme(){
		$res=$this->api->IndexLogin_selectTheme($this->usersession['userid']);
		$Themes=C('THEME');
		$Widths=C('WIDTH');
		$t=array_key_exists($res['theme'],$Themes)? $res['theme'] : 0;
		$w=array_key_exists($res['width'],$Themes)? $res['width'] : 0;
		$this->assign('Themes',$Themes);
		$this->assign('Widths',$Widths);
		$this->assign('Themes_zh',C('THEME_ZH'));
		$this->assign('Widths_zh',C('WIDTH_ZH'));
		$this->assign('theme',$Themes[$t]);
		$this->assign('width',$Widths[$w]);
	}
}
?>
