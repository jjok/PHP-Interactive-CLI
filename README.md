PHP Interactive CLI
===================

An abstract PHP class which can be extended to create a program that accepts multiple lines of input and return output.

An extending class must implement a method called readLine(). This is the function called after each line of input.
If readLine() returns false, the program will exit.

Demo
----

To run demo:

	php demos/run_demo.php


TODO
----

- Better unit tests.
