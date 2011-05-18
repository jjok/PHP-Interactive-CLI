<?php
/**
 * 
 * Demo implementation of PHP Interactive CLI
 * Echos back anything you type in.
 * @author Jonathan Jefferies
 *
 */
final class Test extends InteractiveCLI {

	protected function readLine($command) {
		echo "You just typed: $command\n";
	}
}