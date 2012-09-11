<?php

require_once 'src/jjok/InteractiveCLI.php';
require_once 'demos/Demo.php';

try {
	$app = new Demo();
	$app->setParam('welcome', "\nWelcome! This demo will echo back anything you type.\n\nType \"h\" or \"help\" for help.\n");
	$app->setParam('goodbye', "\nBye!\n");
	$app->setParam('prompt', '>> ');

	$app->run(STDIN);
}
catch(Exception $e) {
	echo 'Fatal error: '.$e->getMessage();
}
