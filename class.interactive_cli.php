<?php
/**
 * 
 * Abstract class 
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

	public function __construct() {
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

	private function loop() {
		while(true) {
			if($this->prompt != '') {
				$prompt = (!isset($line) || $line != '')? "\n$this->prompt": $this->prompt;
				$this->output($prompt);
			}
			#Wait for input
			$line = trim(fgets(STDIN, $this->line_length));

			switch($line) {
				case $this->exit:
					break 2;
				default:
					try {
						$this->readLine($line);
					}
					catch(Exception $e) {
						$this->handleError($e);
					}
			}
		}
	}

	/**
	 * 
	 * Process a line of input
	 * @param string $command
	 * @return void
	 */
	abstract protected function readLine($command);

	/**
	 * 
	 * Enter description here ...
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

	public function __destruct() {
		if($this->debug) {
			$this->output("\nMemory usage: ".memory_get_usage().' bytes');
		}
	}
}