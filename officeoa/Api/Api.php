<?
  import("Db");
    class Api{
		public static $dao;
		public function  __call($func,$args){
			$fun=explode('_',$func);
			$modelname  = ucfirst($fun[0]);
		        $method = $fun[1];
			Api::$dao=$this->getInstance($modelname);
   		        return  (call_user_func_array(array(Api::$dao, $method),$args));	
		
		}
		public function getInstance($modelname){
			$model_class=$modelname.'ApiModel';
			$model_file=THINK_PATH.'../Api/Model/'.$model_class.'.class.php';
			if(!class_exists($model_class)){
				require $model_file;
			}
			
		     return new $model_class();
		
		}

	
	}
?>
