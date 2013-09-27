PHP Interactive CLI
===================

[![Build Status](https://travis-ci.org/jjok/PHP-Interactive-CLI.png)](https://travis-ci.org/jjok/PHP-Interactive-CLI)

An abstract PHP class which can be extended to create a program that accepts multiple lines of input and return output.

An extending class must implement a method called `readLine`. This is the function called after each line of input.
If readLine() returns false, the program will exit.

Demo
----

To run demo:

	cd demos
	php run_demo.php
	php run_demo.php < input.txt

TODO
----

* Add an interface to be implemented by line readers, instead of extending main class.
