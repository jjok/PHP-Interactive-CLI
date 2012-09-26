<?php

namespace jjok\InteractiveCLI;

/**
 * Abstract class which can be extended to create a program that accepts multiple lines of input and prints output.
 * @author Jonathan Jefferies (jjok)
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

// 	/**
// 	 * The welcome message.
// 	 * @var string
// 	 */
// 	private $welcome = '';

// 	/**
// 	 * The exit message.
// 	 * @var string
// 	 */
// 	private $goodbye = '';
	
	/**
	 * Set some properties.
	 * @param string $prompt
	 * @param integer $line_length
	 */
	public function __construct($prompt = '', $line_length = 1024) {
		$this->prompt = $prompt;
		$this->line_length = $line_length;
	}

// 	/**
// 	 * Set any of the parameter properties
// 	 * @param string $param
// 	 * @param mixed $value
// 	 * @throws \Exception
// 	 */
// 	public function setParam($param, $value) {
// 		if(property_exists(__CLASS__, $param)) {
// 			$this->$param = $value;
// 		}
// 		else {
// 			throw new \InvalidArgumentException("Parameter '$param' does not exist.");
// 		}
// 	}

// 	/**
// 	 * Run the program.
// 	 * @param resource $input
// 	 * @throws Exception
// 	 */
// 	public function run($input) {

// 		#Print welcome message
// 		$this->output($this->welcome);

// 		#Run program loop
// 		$this->loop($input);

// 		#Print goodbye message
// 		$this->output($this->goodbye);
// 	}

	/**
	 * Run the program.
	 * @param resource $input
	 */
	public function run($input) {
		
//		try {
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
			
			#If readLine returns false, exit the program
			if(!$this->readLine($line)) {
				break;
			}
		}
//		}
//		catch(\Exception $e) {
//			$this->output($e->getMessage());
//		}
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
