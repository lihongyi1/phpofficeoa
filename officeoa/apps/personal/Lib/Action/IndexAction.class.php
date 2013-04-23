<?php
class IndexAction extends BaseAction {
	public function _initialize() {
			parent :: base();
			
	}
    public function index(){
    	$this->display();
    }
}