<?php
/**
 * 
 * Enter description here ...
 * @author Jonathan Jefferies
 *
 */
abstract class InteractiveCLI {
	protected $goodbye = "bye\n";

	public function __construct($input) {
		#echo '>>';
		#do while
		while($line = trim(fgets($input))) {
			$this->readLine($line);
		}
		if(!is_null($this->goodbye)) echo $this->goodbye;
	}

	abstract protected function readLine($command);
}