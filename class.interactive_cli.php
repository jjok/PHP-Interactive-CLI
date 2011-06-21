<?php
/**
 * 
 * Abstract class 
 * @author Jonathan Jefferies (jjok)
 *
 */
abstract class InteractiveCLI {
	private $line_length = 1024;

	protected $welcome = '';
	protected $prompt = '';
	protected $goodbye = '';
	//protected $help = '';

	protected $commands = array(
		'exit' => ''/*,
		'help' => ''*/
	);

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
				$prompt = (!isset($line) || ($line != '')/* || in_array('', $this->commands)*/)? "\n$this->prompt": $this->prompt;
				$this->output($prompt);
			}
			#Wait for input
			$line = trim(fgets(STDIN, $this->line_length));

			switch($line) {
				case $this->commands['exit']:
					break 2;
				/*case $this->commands['help']:
					if($this->help != '') {
						$this->output($this->help);
						break;
					}
				case '':
					break;*/
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
	 * Output any error message
	 * @param Exception $e
	 */
	protected function handleError(Exception $e) {
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
}