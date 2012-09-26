<?php

require_once 'src/jjok/InteractiveCLI/InteractiveCLI.php';

class TestCli extends \jjok\InteractiveCLI\InteractiveCLI {
	
	public function readLine($input) {
		
		if($input == 'error') {
			throw new \Exception('This is an error.');
		}
		elseif($input == 'continue') {
			return true;
		}
		elseif($input == 'echo') {
			echo 'echo';
			return true;
		}
		echo $input;

		return false;
	}
}

class InteractiveCLITest extends PHPUnit_Framework_TestCase {
	
	public function testNoInput() {
		$cli = new TestCli();

		$cli->run($this->stringToResource(''));
		$this->expectOutputString('');
		
		$cli->run($this->stringToResource("\n\n\n"));
		$this->expectOutputString('');
	}

	/**
	 * Test 
	 */
	public function testPrintInput() {
		$cli = new TestCli();

		$cli->run($this->stringToResource('hi'));
		$this->expectOutputString('hi');
	}

	/**
	 * 
	 */
	public function testMultiLineInput() {
		$cli = new TestCli();
	
		$cli->run($this->stringToResource("continue\nsomething"));
		$this->expectOutputString("something");
	}

	/**
	 * 
	 */
	public function testMultiLineInput2() {
		$cli = new TestCli();
	
		$cli->run($this->stringToResource("continue\necho\necho\nsomethingelse"));
		$this->expectOutputString("echoechosomethingelse");
	}

	/**
	 * Test that the prompt is set and output.
	 */
	public function testPrompt() {
		$cli = new TestCli('blah');

		$cli->run($this->stringToResource(''));
		$this->expectOutputString("\nblah");
	}

	/**
	 * Test that the prompt is set and output.
	 */
	public function testPrompt2() {
		$cli = new TestCli('blah');

		$cli->run($this->stringToResource("continue\ncontinue\necho"));
		$this->expectOutputString("\nblah\nblah\nblahecho\nblah");
	}

	/**
	 * //TODO
	 */
	public function testLineLength() {
 		$cli = new TestCli('', 7);
		$cli->run($this->stringToResource('012345678901234567890123456789'));
 		$this->expectOutputString('012345');
	}

	/**
	 * Test an uncaught exception.
	 */
	public function testCatchError() {
		$cli = new TestCli();

		try {
			$cli->run($this->stringToResource('error'));
		}
		catch(\Exception $e) {
			$this->assertInstanceOf('Exception', $e);
			$this->assertEquals('This is an error.', $e->getMessage());
		}
	}

	/**
	 * Convert an string to a resource.
	 * @param string $string
	 * @return resource
	 */
	private function stringToResource($string) {
		return fopen("data://text/plain,$string", 'r');
	}
}
