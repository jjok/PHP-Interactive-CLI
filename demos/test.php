<?php
require_once '../class.interactive_cli.php';
require_once 'class.test.php';

if(defined('STDIN')) {
	new Test(STDIN);
}