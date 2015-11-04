<?php
require_once('curl.php');

$elements = getTags(getPage($argv[1]), $argv[2]);

foreach($elements as $element){
	echo $element->nodeValue, PHP_EOL;
}
?>
