<?php 
if (isset($_SESSION['flashBag']) && $_SESSION['flashBag'] != array()):
	foreach ($_SESSION['flashBag'] as $key => $message):
		echo "<div class='fade show alert-dismissible alert alert-". $message['type'] ."' style='margin-top:20px;'>";
		echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
		echo $message['message']."";
		echo "</div>\n";
	endforeach;
	unset($_SESSION['flashBag']);
endif; 
?>