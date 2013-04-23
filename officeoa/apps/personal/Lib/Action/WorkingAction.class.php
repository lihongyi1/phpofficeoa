<?php
class WorkingAction extends BaseAction {
	public function _initialize() {
			parent :: base();
			
	}
    public function index(){
    	$this->display();
    }
    public function event(){
    	$events=$this->api->PersonalWorking_getAllEvents();
    	echo json_encode($events);
    }
    public function addEvent(){
    	$title=strip_tags($_POST['title']);
    	$start=strip_tags($_POST['start']);
    	$end=strip_tags($_POST['end']);
    	$allDay=strip_tags($_POST['allDay']);
    	$data['title']=$title;
    	$data['start']=$start;
    	$data['end']=$end;
    	$data['allDay']=$allDay==='true'?1:0;
    	$res=$this->api->PersonalWorking_addEvent($data);
    	if (empty($res)){
    		echo 'error';
    	}else{
    		echo $res;
    	}
    }
 	
    public function updateEvent1(){
    	$eid=intval($_POST['id']);
		$day=intval($_POST['day']);
		$min=intval($_POST['minute']);
		$allDay=$_POST['allDay'];
		$res=$this->api->PersonalWorking_getEvent($eid);
		$start=strtotime($res['start'])+$day*24*3600+$min*60;
		$end=strtotime($res['end'])+$day*24*3600+$min*60;
		$data['start'] =date('Y-m-d h:i:s',intval($start));
		$data['end']=date('Y-m-d h:i:s',intval($end));
		$data['allDay']=$allDay==='true'?1:0;
		$re=$this->api->PersonalWorking_updateEvent($eid,$data);
		if(empty($re)){
			echo 'error';
		}else{
			echo 'success';
		}
    }
    public function updateEvent2(){
    	$eid=intval($_POST['id']);
		$day=intval($_POST['day']);
		$min=intval($_POST['minute']);
		$allDay=$_POST['allDay'];
		$res=$this->api->PersonalWorking_getEvent($eid);
		$end=strtotime($res['end'])+$day*24*3600+$min*60;
		$data['end']=date('Y-m-d h:i:s',intval($end));
		$data['allDay']=$allDay==='true'?1:0;
		$re=$this->api->PersonalWorking_updateEvent($eid,$data);
   		if(empty($re)){
			echo 'error';
		}else{
			echo 'success';
		}
    }
    public function deleteEvent(){
    	$eid=intval($_POST['id']);
    	$res=$this->api->PersonalWorking_deleteEvent($eid);
    	echo $res;
    }
    
}