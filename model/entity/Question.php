<?php

class Question {

    public $slug;
    
	public function getAnswer()	{
		$answer = $this->answer;
		$answer = str_replace(" ", "", $answer);
		$answer = strtolower($answer);
	}
	
	public function insertImage($path) {
	    $fileName = sha1($this->answer);
	    file_put_contents($path . $fileName, $this->image);
	    return $fileName;
	}
}