<?php 
class MyMode extends Action{
		
	public $usersession;
	
	public function start(){
		$this->sA();
		$this->stheme();
	}
	public function sA(){
		$this->usersession=$_SESSION['usersession']['user'];
		$this->assign('usersession',$this->usersession);
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
