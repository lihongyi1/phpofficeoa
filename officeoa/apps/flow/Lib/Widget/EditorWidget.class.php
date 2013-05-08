<?php 
class EditorWidget extends Widget{
	public function render($data){
		$content = $this->renderFile("Editor",$data);
        return $content;
	}
}
?>