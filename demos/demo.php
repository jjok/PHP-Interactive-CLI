<?php
require_once '..'.DIRECTORY_SEPARATOR.'InteractiveCLI.php';
require_once 'class.demo.php';

try {
	$app = new Demo();
	$app->run(STDIN);
}
catch(Exception $e) {
	exit('Fatal error: '.$e->getMessage());
}
