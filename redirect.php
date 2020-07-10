<?php
date_default_timezone_set('America/New_York');

$day = date('j');
$month = strtolower(date('F'));
	
header('Location: http://172.16.17.70/'. $month. '/'. $month. '-'. $day)
	
?>
