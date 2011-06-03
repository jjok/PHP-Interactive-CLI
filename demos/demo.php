<?php
require_once '../class.interactive_cli.php';
require_once 'class.demo.php';

try {
	new Demo();
}
catch(Exception $e) {
	exit('Fatal error: '.$e->getMessage());
}