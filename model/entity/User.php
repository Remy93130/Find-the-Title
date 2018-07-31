<?php

class User {

	public function getLink() {
		return "index.php?action=profile&id=$this->id";
	}
	
}