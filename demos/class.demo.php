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
		#$this->commands['help'] = 'help';
		#$this->help = 'Type "exit" to exit.';
		parent::__construct();
	}

	protected function readLine($command) {
		switch($command) {
			case '':
				#$this->output('Type "exit" to exit.');
				break;
			default:
				$this->output("You just typed: $command");
		}
	}
}