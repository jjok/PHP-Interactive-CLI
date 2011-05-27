<?php
/**
 * 
 * Enter description here ...
 * @author Jonathan Jefferies
 *
 */
abstract class InteractiveCLI {
	private $history = array();

	protected $welcome = '';
	protected $prompt = '';
	protected $goodbye = '';
	protected $exit = '';
	#protected $help = 'Type "exit" to exit.';

	public function __construct() {
		if(defined('STDIN')) {
			echo $this->welcome;
	
			while(true) {
				if($this->prompt != '') {
					echo "\n$this->prompt";
				}
				$line = trim(fgets(STDIN));
	
				switch($line) {
					case $this->exit:
						break 2;
					case '':
						#echo $this->help;
						continue 2;
					default:
						try {
							$this->readLine($line);
						}
						catch(Exception $e) {
							$this->handleError($e);
						}
				}
			}
			echo $this->goodbye;
		}
		else throw new Exception('This program runs for the command line.');
	}

	abstract protected function readLine($command);

	/**
	 * 
	 * Enter description here ...
	 * @param string $command
	 */
	protected function addToHistory($command) {
		$this->history[] = $command;
	}

	protected function getHistory() {
		return $this->history;
	}

	/**
	 * 
	 * Clear the command history
	 * @return void
	 */
	protected function clearHistory() {
		$this->history = array();
	}

	protected function handleError(Exception $e) {
		echo $e->getMessage();
	}
}