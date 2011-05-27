<?php
/**
 * 
 * Demo implementation of PHP Interactive CLI
 * Echos back anything you type in.
 * @author Jonathan Jefferies
 *
 */
final class Test extends InteractiveCLI {

	public function __construct() {
		$this->welcome = 'Welcome!';
		$this->prompt = '>> ';
		$this->goodbye = 'Bye!';
		$this->exit = 'exit';
		parent::__construct();
	}

	protected function readLine($command) {
		echo "You just typed: $command";
	}
}