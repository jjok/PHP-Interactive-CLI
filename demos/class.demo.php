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
		$this->setParam('welcome', "\nWelcome! This demo will echo back anything you type.\n\nType \"h\" or \"help\" for help.\n");
		$this->setParam('goodbye', "\nBye!\n");
		$this->setParam('prompt', '>> ');
		$this->setParam('exit', 'exit');
		$this->setParam('debug', false);
		parent::__construct();
	}

	/**
	 * 
	 * Print out any input
	 * @param string $command
	 */
	protected function readLine($command) {
		switch($command) {
			#Don't do anything, if nothing was typed
			case '':
				break;
			#Help
			case 'h':
			case 'help':
				$this->output('Type "e" or exit" to exit.');
				break;
			case 'e':
				return false;
			#Any other text input
			default:
				$this->output("You just typed: $command");
		}
	}
}