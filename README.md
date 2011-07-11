PHP Interactive CLI
===================

An abstract PHP class which can be extended to create a program that accepts multiple lines of input and return output.

An extending class must implement a method called readLine(). This is the function called after each line of input.
If readLine() returns false, the program will exit.

See demo.

To run demo:

	>> cd demos
	>> php demo.php

Also see https://github.com/jjok/Text-Adventure-Engine