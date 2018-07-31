<?php

namespace App;

class Autoload {
	
	public static function register() {
		spl_autoload_register(array(__CLASS__, 'loadClasses'));
	}

	public static function loadClasses($className) {
		require $className . '.php';
	}	
}
