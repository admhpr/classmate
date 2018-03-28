<?php
class Messages{
	public static function setMsg($text, $type){
		if($type == 'error'){
			$_SESSION['errorMsg'] = $text;
		} else {
			$_SESSION['successMsg'] = $text;
		}
	}

	public static function display(){
		if(isset($_SESSION['errorMsg'])){
			echo '<div class="message is-danger">
					<div class="message-body">'
						.$_SESSION['errorMsg'].
				  	'</div>
				  </div>';
			unset($_SESSION['errorMsg']);
		}

		if(isset($_SESSION['successMsg'])){
			echo '<div class="message is-success">
					<div class="message-body">'
						.$_SESSION['successMsg'].
				  	'</div>
				  </div>';
			unset($_SESSION['successMsg']);
		}
	}
}