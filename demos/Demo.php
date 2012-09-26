<?php
/**
 * 
 * Demo implementation of PHP Interactive CLI.
 * 
 * Echos back anything you type in.
 * @author Jonathan Jefferies (jjok)
 */
class Demo extends \jjok\InteractiveCLI\InteractiveCLI {

	/**
	 * Process each line of input.
	 * @param string $command
	 * @return boolean The program should keep running.
	 */
	protected function readLine($input) {
		switch($input) {
			# Don't do anything, if nothing was typed
			case '':
				break;

			# Help
			case 'h':
			case 'help':
				$this->output('Type "e" or "exit" to exit.');
				break;

			# Exit
			case 'e':
			case 'exit':
				return false;
			
			case 'error':
				throw new \Exception('Something bad happened.');

			# Any other text input
			default:
				$this->output("You just typed: $input");
		}

		# Keep the program running.
		return true;
	}
}
