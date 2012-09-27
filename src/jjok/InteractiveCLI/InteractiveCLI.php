<?php

namespace jjok\InteractiveCLI;

/**
 * Abstract class which can be extended to create a program that accepts multiple lines of input and prints output.
 * @author Jonathan Jefferies (jjok)
 * @version 1.0.0
 * https://github.com/jjok/PHP-Interactive-CLI
 */
abstract class InteractiveCLI {

	/**
	 * The maximum number of bytes to read from each line.
	 * @var int
	 */
	private $line_length;

	/**
	 * The prompt.
	 * @var string
	 */
	private $prompt;
	
	/**
	 * Set some properties.
	 * @param string $prompt
	 * @param integer $line_length
	 */
	public function __construct($prompt = '', $line_length = 1024) {
		$this->prompt = $prompt;
		$this->line_length = $line_length;
	}

	/**
	 * Run the program.
	 * @param resource $input
	 */
	public function run($input) {

		while(true) {
			
			#Print a prompt, if required.
			if($this->prompt != '') {
				if (!isset($line) || $line != '') {
					$this->output(PHP_EOL);
				}
				$this->output($this->prompt);
			}
			
			#Wait for input
			$line = trim(fgets($input, $this->line_length));
			
			#If readLine returns false, exit the program
			if(!$this->readLine($line)) {
				break;
			}
		}
	}

	/**
	 * Print output.
	 * @param string $output
	 */
	protected function output($output) {
		echo $output;
	}

	/**
	 * Process each line of input.
	 * @param string $command
	 * @return boolean The program should keep running.
	 */
	abstract protected function readLine($command);
}
