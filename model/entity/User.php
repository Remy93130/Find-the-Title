<?php

class User {

	public function getDelete() {
		return "index_admin.php?action=delete&target=user&id=$this->id&token=";
	}
}
