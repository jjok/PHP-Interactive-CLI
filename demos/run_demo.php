<?php

require_once '../src/jjok/InteractiveCLI/InteractiveCLI.php';
require_once 'Demo.php';

try {
	$app = new Demo('>> ');

	echo "\nWelcome! This demo will echo back anything you type.\n\nType \"h\" or \"help\" for help.\n";

	$app->run(STDIN);

	echo "\nBye!\n";
}
catch(Exception $e) {
	echo 'Fatal error: '.$e->getMessage();
}
