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
		$this->setParam('welcome', 'Welcome!');
		$this->setParam('goodbye', 'Bye!');
		$this->setParam('prompt', '>> ');
		$this->setParam('exit', 'exit');
		$this->setParam('debug', true);
		parent::__construct();
	}

	/**
	 * 
	 * Print out any input
	 * @param string $command
	 */
	protected function readLine($command) {
		switch($command) {
			case '':
				break;
			default:
				$this->output("You just typed: $command");
		}
	}
}