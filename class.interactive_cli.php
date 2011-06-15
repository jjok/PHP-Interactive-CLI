<?php
/**
 * 
 * Enter description here ...
 * @author Jonathan Jefferies (jjok)
 *
 */
abstract class InteractiveCLI {
	private $length = 1024;
	private $history = array();

	protected $welcome = '';
	protected $prompt = '';
	protected $goodbye = '';
	#protected $exit = '';
	#protected $help = 'Type "exit" to exit.';

	protected $commands = array(
		'exit' => '',
		'help' => 'help'
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
				$this->output("\n$this->prompt");
			}
			#Wait for input
			$line = trim(fgets(STDIN, $this->length));

			switch($line) {
				case $this->commands['exit']:
					break 2;
				case $this->commands['help']:
					#echo $this->help;
					echo 'this is the help';
					break;
					#continue 2;
				case '':
					break;
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

	abstract protected function readLine($command);

	/**
	 * 
	 * Store the command for future use
	 * @param string $command
	 * @return void
	 */
	final protected function addToHistory($command) {
		$this->history[] = $command;
	}

	/**
	 * 
	 * Get the currently stored history
	 * @return array
	 */
	final protected function getHistory() {
		return $this->history;
	}

	/**
	 * 
	 * Clear the command history
	 * @return void
	 */
	final protected function clearHistory() {
		$this->history = array();
	}

	/**
	 * 
	 * Output any error message
	 * @param Exception $e
	 */
	protected function handleError(Exception $e) {
		$this->output($e->getMessage());
	}

	protected function output($output) {
		echo $output;
	}
}