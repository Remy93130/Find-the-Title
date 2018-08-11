<?php

class Message {
	
	public function getDelete() {
		return "index_admin.php?action=delete&target=message&id=$this->id&token=";
	}
}
