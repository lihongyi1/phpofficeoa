<?php 
return  array(
	'core'	=>	array(
		MODE_PATH.'MyMode/Action.class.php',
		MODE_PATH.'MyMode/App.class.php',
		MODE_PATH.'MyMode/Dispatcher.class.php',
		MODE_PATH.'MyMode/Log.class.php',
		THINK_PATH.'Common/functions.php',   // 系统函数库
		MODE_PATH.'MyMode/View.class.php',
		MODE_PATH.'MyMode/Widget.class.php',
		MODE_PATH.'MyMode/MyMode.class.php',
	     //	THINK_PATH.'../Api/Api.php'	
	),

	// 项目别名定义文件 [支持数组直接定义或者文件名定义]
    'alias'         =>    array(
        'Model'         =>   MODE_PATH.'MyMode/Model.class.php',
        'Db'                  =>    MODE_PATH.'MyMode/Db.class.php',
		'Page'   => 	THINK_PATH.'Lib/ORG/Util/Page.class.php',
		'Http'   => 	THINK_PATH.'Lib/ORG/Util/Http.class.php',
		'UploadFile'   => 	THINK_PATH.'Lib/ORG/Util/UploadFile.class.php',
    ), 
);
?>
