<?php
require_once '../class.interactive_cli.php';
require_once 'class.test.php';

try {
	new Test();
}
catch(Exception $e) {
	echo 'Error: '.$e->getMessage();
	exit();
}