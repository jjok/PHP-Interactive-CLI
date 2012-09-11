<?php

require_once 'src/jjok/InteractiveCLI.php';

class TestCli extends \jjok\InteractiveCLI {
	
	public function readLine($input) {
		
		if($input == 'error') {
			throw new \Exception('This is an error.');
		}
		elseif($input == 'continue') {
			return false;
		}
		echo $input;
		return true;
	}
}

class InteractiveCLITest extends PHPUnit_Framework_TestCase {

	
	public function testNoInput() {
		$cli = new TestCli();

		$cli->run($this->stringToResource(''));
		$this->expectOutputString('');
	}
	
	public function testPrintInput() {
		$cli = new TestCli();

		$cli->run($this->stringToResource('hi'));
		$this->expectOutputString('hi');
	}

	public function testMultiLineInput() {
		$cli = new TestCli();
	
		$cli->run($this->stringToResource("continue\nsomething"));
		$this->expectOutputString("something");
	}

	public function testPrompt() {
		$cli = new TestCli();
		$cli->setParam('prompt', 'blah');
		$cli->run($this->stringToResource(''));
		$this->expectOutputString("\nblah");
	}

	public function testWelcomeMessage() {
		
	}
	
	public function testExitMessage() {
	
	}

	public function testSetBadParam() {
		$cli = new TestCli();
		
		try {
			$cli->setParam('bad', 'value');
		}
		catch(\Exception $e) {
			$this->assertInstanceOf('Exception', $e);
		}
	}

	public function testCatchError() {
		$cli = new TestCli();

		try {
			$cli->run($this->stringToResource('error'));
		}
		catch(\Exception $e) {
			$this->assertInstanceOf('Exception', $e);
		}
	}

	private function stringToResource($string) {
		return fopen("data://text/plain,$string", 'r');
	}
}
