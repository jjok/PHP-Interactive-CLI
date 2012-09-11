<?php

namespace jjok;

/**
 * Abstract class which can be extended to create a program that accepts multiple lines of input and prints output.
 * @author Jonathan Jefferies (jjok)
 * https://github.com/jjok/PHP-Interactive-CLI
 */
abstract class InteractiveCLI {

	/**
	 * The maximum length to read from each line.
	 * @var int
	 */
	private $line_length = 1024;

	/**
	 * The prompt.
	 * @var string
	 */
	private $prompt = '';

	/**
	 * The welcome message.
	 * @var string
	 */
	private $welcome = '';

	/**
	 * The exit message.
	 * @var string
	 */
	private $goodbye = '';

// 	/**
// 	 * The command to exit the program.
// 	 * @var string
// 	 */
// 	private $exit = '';

	/**
	 * Run the program.
	 * @param resource $input
	 * @throws Exception
	 */
	public function run($input) {

		#Print welcome message
		$this->output($this->welcome);

		#Run program loop
		$this->loop($input);

		#Print goodbye message
		$this->output($this->goodbye);
	}

	/**
	 * Process each line of input.
	 * @param resource $input
	 */
	private function loop($input) {
		
		try {
			while(true) {
				
				#Print a prompt, if required.
				if($this->prompt != '') {
					if (!isset($line) || $line != '') {
						$this->output("\n");
					}
					$this->output($this->prompt);
				}
				
				#Wait for input
				$line = trim(fgets($input, $this->line_length));
				
				#If readLine returns true, exit the program
				if($this->readLine($line)) {
					break;
				}
			}
		}
		catch(\Exception $e) {
			$this->output($e->getMessage());
		}
	}

// 	/**
// 	 * Handle any error message
// 	 * @param \Exception $e
// 	 */
// 	private function handleError(\Exception $e) {
// 		$this->output($e->getMessage());
// 	}

	/**
	 * Set any of the parameter properties
	 * @param string $param
	 * @param mixed $value
	 * @throws \Exception
	 */
	public function setParam($param, $value) {
		if(property_exists('\jjok\InteractiveCLI', $param)) {
			$this->$param = $value;
		}
		else throw new \Exception("Parameter '$param' does not exist.");
	}

	/**
	 * Print output
	 * @param string $output
	 */
	protected function output($output) {
		echo $output;
	}

	/**
	 * Process each line of input.
	 * @param string $command
	 * @return boolean The program should exit.
	 */
	abstract protected function readLine($command);
}
