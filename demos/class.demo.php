<?php
/**
 * 
 * Demo implementation of PHP Interactive CLI
 * Echos back anything you type in.
 * @author Jonathan Jefferies (jjok)
 *
 */
final class Demo extends InteractiveCLI {

	public function __construct() {
		$this->welcome = 'Welcome!';
		$this->prompt = '>> ';
		$this->goodbye = 'Bye!';
		$this->commands['exit'] = 'exit';
		parent::__construct();
	}

	protected function readLine($command) {
		$this->output("You just typed: $command");
	}
}