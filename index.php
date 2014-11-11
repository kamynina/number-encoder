<?php
include_once("NumberEncoder.php");

$alphabet32 = array(
    0, 1,
    // 2, 3, 4, 5, 6, 7, 8, 9,
//    'a', 'b', 'c', 'd', 'e', 'f', 'j', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v'
);
var_dump($argv[1]);
if (!empty($argv[1])) {
    $encoder = new NumberEncoder($alphabet32);
    $result = $encoder->encode($argv[1]);
    echo "result is " . $result;
}
?>