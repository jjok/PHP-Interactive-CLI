<?php
/**
 * 
 * Enter description here ...
 * @author Jonathan Jefferies
 *
 */
abstract class InteractiveCLI {
	protected $welcome = 'Welcome!';
	protected $prompt = '>> ';
	protected $goodbye = 'Bye!';
	protected $exit = 'exit';

	public function __construct() {
		echo $this->welcome;

		while(true) {
			echo "\n$this->prompt";
			$line = trim(fgets(STDIN));

			switch($line) {
				case $this->exit:
					break 2;
				case '':
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

	abstract protected function readLine($command);

	protected function handleError(Exception $e) {
		echo $e->getMessage();
	}
}