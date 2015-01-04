<?php
include_once("NumberEncoder.php");

$alphabet32 = array(
    0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'j', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v'
);
function encode($input) {
	global $alphabet32;
    $encoder = new NumberEncoder($alphabet32);
    $result = $encoder->encode($input);
    echo "result is " . $result;
}
function decode($input) {
	global $alphabet32;
    $encoder = new NumberEncoder($alphabet32);
    $result = $encoder->decode($input);
    echo "decode result is " . $result;
}
if (isset($argv[1])) {
	encode($argv[1]);
}
if (isset($_GET['a'])) {
	if (isset($_GET['d'])) {
		decode($_GET['a']);
	} else {
		encode($_GET['a']);
	}
}

?>