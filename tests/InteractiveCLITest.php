<?php

require_once 'src/jjok/InteractiveCLI/InteractiveCLI.php';

class InteractiveCliTest extends PHPUnit_Framework_TestCase {
	
	public function testNoInput() {
		$cli = new DummyCli();

		$cli->run($this->stringToResource(''));
		$this->expectOutputString('');
		
		$cli->run($this->stringToResource("\n\n\n"));
		$this->expectOutputString('');
	}

	/**
	 * Test 
	 */
	public function testInputIsOutput() {
		$cli = new DummyCli();
		$cli->run($this->stringToResource('hi'));
		
		$this->expectOutputString('hi');
	}

	/**
	 * 
	 */
	public function testMultiLineInput() {
		$cli = new DummyCli();
		$cli->run($this->stringToResource("continue\nsomething"));
		
		$this->expectOutputString("something");
	}

	/**
	 * 
	 */
	public function testMultiLineInput2() {
		$cli = new DummyCli();
		$cli->run($this->stringToResource("continue\necho\necho\nsomethingelse"));
		
		$this->expectOutputString("echoechosomethingelse");
	}

	/**
	 * Test that the prompt is set and output.
	 */
	public function testPromptCanBeSet() {
		$cli = new DummyCli('blah');
		$cli->run($this->stringToResource(''));

		$this->expectOutputString(sprintf('%sblah', PHP_EOL));
	}

	/**
	 * Test that the prompt is set and output.
	 */
	public function testPromptCanBeSet2() {
		$cli = new DummyCli('blah');
		$cli->run($this->stringToResource("continue\ncontinue\necho"));

		$this->expectOutputString(sprintf('%sblah%sblah%sblahecho%sblah', PHP_EOL, PHP_EOL, PHP_EOL, PHP_EOL));
	}

	/**
	 * //TODO
	 */
	public function testLineLengthCanBeSet() {
 		$cli = new DummyCli('', 1);
 		
 		$res = $this->stringToResource('abcdefghijklmnopqrstuvwxwz');
		$cli->run($res);
 		$this->expectOutputString('a');
 		
 		$cli->run($res);
 		$this->expectOutputString('ab');
 		
 		$cli->run($res);
 		$this->expectOutputString('abc');
 		
 		$cli2 = new DummyCli('', 6);
 		$cli2->run($res);
		$this->expectOutputString('abcdefghi');

		$cli2->run($res);
		$this->expectOutputString('abcdefghijklmno');
		
		$cli2->run($res);
		$this->expectOutputString('abcdefghijklmnopqrstu');
	}

	/**
	 * Test an uncaught exception.
	 */
	public function testCatchError() {
		$cli = new DummyCli();

		try {
			$cli->run($this->stringToResource('error'));
		}
		catch(\Exception $e) {
			$this->assertInstanceOf('RuntimeException', $e);
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
