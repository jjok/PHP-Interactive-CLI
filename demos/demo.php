<?php
require_once '..'.DIRECTORY_SEPARATOR.'class.interactive_cli.php';
require_once 'class.demo.php';

try {
	$app = new Demo();
	$app->run();
}
catch(Exception $e) {
	exit('Fatal error: '.$e->getMessage());
}