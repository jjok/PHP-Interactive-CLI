<?php

namespace JJOK;

/**
 * Abstract class which can be extended to create a program that accepts multiple lines of input and return output.
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
	 * 
	 * @var string
	 */
	private $prompt = '';

	/**
	 * 
	 * @var string
	 */
	private $welcome = '';

	/**
	 * 
	 * @var string
	 */
	private $goodbye = '';

	/**
	 * 
	 * @var string
	 */
	private $exit = '';

	/**
	 * Run the program.
	 * @throws Exception
	 */
	public function run($input) {
		//if(defined('STDIN')) {
		#Print welcome message
		$this->output($this->welcome);

		#Run program loop
		#$this->loop(STDIN);
		$this->loop($input);

		#Print goodbye message
		$this->output($this->goodbye);
		//}
		//else throw new Exception('This program runs from the command line.');
	}

	/**
	 * Process each line of input.
	 * @param resource $input
	 * @return void
	 */
	private function loop($input) {
		
		try {
			while(true) {
				#Print a prompt, if required.
				if($this->prompt != '') {
					#$prompt = (!isset($line) || $line != '')? "\n$this->prompt": $this->prompt;
					if (!isset($line) || $line != '') {
						$this->output("\n");
					}
					$this->output($this->prompt);
				}
				
				#Wait for input
				$line = trim(fgets($input, $this->line_length));

				#If the exit command was entered, or readLine returns false, exit the program
				if($line === $this->exit || $this->readLine($line) === false) {
					break;
				}
			}
		}
		catch(Exception $e) {
			$this->handleError($e);
		}
	}

	/**
	 *
	 * Output any error message
	 * @param Exception $e
	 */
	private function handleError(Exception $e) {
		$this->output($e->getMessage());
	}

	/**
	 * Set any of the parameter properties
	 * @param string $param
	 * @param mixed $value
	 * @throws Exception
	 */
	protected function setParam($param, $value) {
		if(property_exists('InteractiveCLI', $param)) {
		#if(isset($this->$param)) {
			$this->$param = $value;
		}
		else throw new Exception("Parameter '$param' does not exist.");
	}

	/**
	 * 
	 * Print output
	 * @param string $output
	 */
	protected function output($output) {
		echo $output;
	}

	/**
	 * Process a line of input.
	 * @param string $command
	 * @return boolean
	 */
	abstract protected function readLine($command);
}
