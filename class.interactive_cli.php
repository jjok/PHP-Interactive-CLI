<?php
/**
 * 
 * Abstract class which can be extended to create a program that accepts multiple lines of input and return output.
 * @author Jonathan Jefferies (jjok)
 * https://github.com/jjok/PHP-Interactive-CLI
 *
 */
abstract class InteractiveCLI {

	private $line_length = 1024;
	private $prompt = '';
	private $welcome = '';
	private $goodbye = '';
	private $exit = '';
	private $debug = false;

	/**
	 * 
	 * Enter description here ...
	 * @throws Exception
	 */
	public function run() {
		if(defined('STDIN')) {
			#Print welcome message
			$this->output($this->welcome);

			#Run program loop
			$this->loop();

			#Print goodbye message
			$this->output($this->goodbye);
		}
		else throw new Exception('This program runs from the command line.');
	}

	/**
	 * 
	 * Enter description here ...
	 * @return void
	 */
	private function loop() {
		while(true) {
			if($this->prompt != '') {
				$prompt = (!isset($input) || $input != '')? "\n$this->prompt": $this->prompt;
				$this->output($prompt);
			}
			#Wait for input
			$input = trim(fgets(STDIN, $this->line_length));

			try {
				#If the exit command was entered, or readLine returns false, exit the program
				if($input === $this->exit || $this->readLine($input) === false) {
					break;
				}
			}
			catch(Exception $e) {
				$this->handleError($e);
			}
		}
	}

	/**
	 * 
	 * Process a line of input.
	 * @param string $command
	 * @return boolean
	 */
	abstract protected function readLine($command);

	/**
	 * 
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
	 * Output any error message
	 * @param Exception $e
	 */
	private function handleError(Exception $e) {
		$this->output($e->getMessage());
	}

	/**
	 * 
	 * Print output
	 * @param string $output
	 */
	protected function output($output) {
		echo $output;
	}

	/*public function __destruct() {
		if($this->debug) {
			$this->output("\n\nMemory usage: ".memory_get_usage().' bytes');
			$this->output("\nMemory peak usage: ".memory_get_peak_usage().' bytes');
		}
	}*/
}