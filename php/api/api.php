<?php
require_once 'api.class.php';
try {
	$API = new API($_REQUEST['request']);
	echo $API->processAPI();
} catch(Exception $e) {
	echo $e->getMessage();
}
?>
