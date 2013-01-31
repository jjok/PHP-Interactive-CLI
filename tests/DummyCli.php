<?php

class DummyCli extends \jjok\InteractiveCLI\InteractiveCLI {

	public function readLine($input) {

		if($input == 'error') {
			throw new \RuntimeException('This is an error.');
		}
		elseif($input == 'continue') {
			return true;
		}
		elseif($input == 'echo') {
			echo 'echo';
			return true;
		}

		echo $input;

		return false;
	}
}
