<?
class PersonalWorkingApiModel extends Model{
	public function __construct(){
		$db_config=C('db_config');
		$this->db = Db::getInstance($db_config);
	}
	public function getAllEvents(){
		$events=$this->table(C('DB_PREFIX').'event')->field(array('id','title','start','end','allDay'))->where(array('isdelete'=>0))->select();
		foreach ($events as $key=>$event) {
			if($event['allDay']==1){
				$events[$key]['start']=date('Y-m-d',strtotime($event['start']));
				unset($events[$key]['allDay']);
				if(empty($event['end'])){
					unset($events[$key]['end']);
				}else{
					$events[$key]['end']=date('Y-m-d',strtotime($event['end']));
				}
			}else{
				$events[$key]['start']=date('Y-m-d h:i:s',strtotime($event['start']));
				$events[$key]['allDay']=false;
				if(empty($event['end'])){
					unset($events[$key]['end']);
				}else{
					$events[$key]['end']=date('Y-m-d h:i:s',strtotime($event['end']));
				}
			}
		}
		return $events;
	}
	public function addEvent($data){
		$res=$this->table(C('DB_PREFIX').'event')->add($data);
		return $res;
	}
	public function getEvent($eid){
		$res=$this->table(C('DB_PREFIX').'event')->where(array('id'=>$eid,'isdelete'=>0))->find();
		return $res;
	}
	public function updateEvent($eid,$data){
		$res=$this->table(C('DB_PREFIX').'event')->where(array('id'=>$eid,'isdelete'=>0))->save($data);
		return $res;
	}
	public function deleteEvent($eid){
		$res=$this->table(C('DB_PREFIX').'event')->where(array('id'=>$eid))->save(array('isdelete'=>1));
		return $res;
	}
	
	

}
?>
