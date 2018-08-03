<?php

class Question {

	public function getAnswer()	{
		$answer = $this->answer;
		$answer = str_replace(" ", "", $answer);
		$answer = strtolower($answer);
	}
}